#include <stdio.h>
#include <stdint.h>

#include <curl/curl.h>

#define BUFLEN 256


// стуктура, описывающая лимит
#pragma pack(push, 1)
struct limit {
	uint32_t id;
	char name[255];
	char measure[16];
	char quantity[16];
};
#pragma pack(pop)


// контейнер для побайтного чтения лимитов из облака
struct limit_container {
  unsigned short count;
  struct limit *limits;
  size_t cursor;
};

// стуктура для отправки данных в облако
#pragma pack(push, 1)
struct post_data {
	char number[16];
	uint32_t limit_id;
	double quantity;
};
#pragma pack(pop)

// структура, описывающая ответ облака на запрос "авторизации"
struct auth_result {
	unsigned short status_code;
	char overdrawing[16];
};

// структура для чтения ответа из облака на запрос авторизации
struct auth_result_container {
	struct auth_result *result;
	size_t cursor;
};

// callback для чтения списка лимитов из облака
size_t writefunc2(void *ptr, size_t size, size_t nmemb, struct limit_container *d)
{
	if (d->count == 0) {
		memcpy(&d->count, ptr, sizeof(unsigned short));
		ptr = (unsigned short *) ptr + 1;
		d->limits = (struct limit *) malloc (sizeof (struct limit) * d->count);
	}
	memcpy(d->limits+d->cursor, ptr, size*nmemb);
	d->cursor += size*nmemb;

	return size*nmemb;
}

// callback для чтения ответа на авторизацию
unsigned int response_function(void *ptr, size_t size, size_t nmemb, struct auth_result_container *d)
{
	memcpy(d->result+d->cursor, ptr, size*nmemb);
	d->cursor += size*nmemb;

	return size*nmemb;
}

// посылает запрос в облако на получение списка лимитов
struct limit_container request_card_limits() {
	CURL *curl;
	CURLcode res;

	struct limit_container d;
	d.cursor = 0;
	d.count = 0;

	curl = curl_easy_init();
	if (!curl) {
	}
   
    curl_easy_setopt(curl, CURLOPT_URL, "185.91.175.144/api/limits.php");
	 
	d.limits = (struct limit *) malloc (sizeof (struct limit) * 2);
	 
    curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, writefunc2);
    curl_easy_setopt(curl, CURLOPT_WRITEDATA, &d);
    res = curl_easy_perform(curl);
	curl_easy_cleanup(curl);
	return d;
}

// посылает запрос на авторизацию
struct auth_result *request_auth(struct post_data *data) {
	CURL *curl;
	CURLcode res;

	struct auth_result_container rc;
	rc.cursor = 0;
	rc.result = (struct auth_result *) malloc (sizeof (struct auth_result) );

	curl = curl_easy_init();
	if (!curl) {
	}
   
    curl_easy_setopt(curl, CURLOPT_URL, "185.91.175.144/api/auth.php");

	curl_easy_setopt(curl, CURLOPT_POSTFIELDSIZE, sizeof(struct post_data));
	curl_easy_setopt(curl, CURLOPT_COPYPOSTFIELDS,  data);
	curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, response_function);
	curl_easy_setopt(curl, CURLOPT_WRITEDATA, &rc);


	//curl_easy_setopt(curl, CURLOPT_READDATA, data);
    res = curl_easy_perform(curl);
	curl_easy_cleanup(curl);
	return rc.result;
}

int validate_card(char digits[]) {
    // вычисление контрольной суммы
    int sum = 0;
	int i;
    for (i = 0; i < 16; i++) {
        // использовать четные цифры как есть
		int val;
		int digit = digits[15 - i] - '0';
        if ((i % 2) == 0) {
            val = digit;
        } else {
            // удвоить нечетные цифры и вычесть 9, если они больше 9
            val = digit * 2;
            if (val > 9)  val -= 9;
        }
        sum += val;
    }

    // число корректно, если сумма равна 10
    return ((sum % 10) == 0);
}

// запрашивает номер карты и возвращает результат валидации
int prompt_card_number(char buffer[]) {
	printf("Введите номер карты:\n");
	fflush(stdout);
	fgets(buffer, BUFLEN, stdin);
	return validate_card(buffer);
}


// Выводит табличку лимитов
void print_limit_table(struct limit *limits, int count) {
	int i;

	for (i = 0; i < count; i++) {
		printf("%i	%s	%s	%s\n", i + 1, limits[i].name, limits[i].measure, limits[i].quantity);
	}
}

// Запрашивает количество
double prompt_quantity() {
	char buffer[BUFLEN];
	float quantity;
	
	printf( "Введите количество:\n");
	scanf("%f", &quantity );
	fflush(stdin);
	return quantity;
}

// Запрашивает номер лимита в цикле, пока пользователь не введет корректный номер
int prompt_limit_index(int count) {
	char buffer[BUFLEN];
	int index;

	do {
		printf( "Введите номер Лимита:\n");
		scanf("%i", &index );
	fflush(stdin);
	} while (index <= 0 || index > count);
	return index;
}

// Точка входа
int main(void) {

// Включаем UTF8 в Windows
#if defined(_WIN32)
	SetConsoleCP(CP_UTF8);
	SetConsoleOutputCP(CP_UTF8);
#endif
	
	while (1) {
		char buffer[BUFLEN];
		struct post_data post;
		struct auth_result *result;
		struct limit_container d;
		int limit_index;
		double quantity;
		memset(&buffer, 0, BUFLEN);
		// запрашиваем валидный номер карты
		while (!prompt_card_number(buffer)) {
		  printf( "Некорректный номер! ");
		}
		printf( "Номер карты корректен. Запрашиваем лимиты...\n");

		// делаем запрос в облако на получение лимитов
		d = request_card_limits();

		// выводим таблицу лимитов
		print_limit_table(d.limits, d.count);

		// ждем ввода номера лимита от пользователя
		limit_index = prompt_limit_index(d.count);

		// ждем ввода количества
		quantity = prompt_quantity();
		
		// подготавливаем данные для отправки в облако
		post.limit_id = d.limits[limit_index - 1].id;
		post.quantity = quantity;
		memcpy(post.number, buffer, 16);

		// делаем запрос на "авторизацию" в облако
		result = request_auth(&post);
		switch (result->status_code) {
		case 0:
			printf("Результат: отказ");
			break;
		case 1:
			printf("Результат: одобрено");
			break;
		case 2:
			printf("Результат: лимит превышен на %s", result->overdrawing);
			break;
		}
		printf("\n");
		getchar();
		getchar();
	}
	return 0;
}