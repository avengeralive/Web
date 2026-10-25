#include <iostream>
using namespace std;

int main() {
	int arr[10][10];
	int i,j,a,b;
	for (i=0; i<10; i++) {
		for (j=0; j<10; j++) {
			cin >> arr[i][j];
		}
	}
	cin >> a >> b;
	if (arr[a-1][b-1] == 1) arr[a-1][b-1] = 2;
	for (i=0; i<10; i++) {
		for (j=0; j<9; j++) {
			cout << arr[i][j] << " ";
		}
		cout << arr[i][9] << endl;
	}
	return 0;
}
