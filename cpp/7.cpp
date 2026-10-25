#include <iostream>
#include <cmath>
using namespace std;

int main() {
	int arr[100];
	int bar[100];
	int i,n,k,j,l;
	cin >> n;
	for (i=0; i<n; i++) {
		cin >> arr[i];
	}
	cin >> k;
	for (j=0; j<k; j++) {
		l=0;
		for (i=0; i<n; i+=2) {
			bar[l] = arr[i];
			l++;
		}
		for (i=1; i<n; i+=2) {
			bar[l] = arr[i];
			l++;
		}
		for (i=0; i<n; i++) {
			arr[i] = bar[i];
		}
		for (i=0; i<n-1; i++) {
			cout << arr[i] << " ";
		}
		cout << arr[n-1] << endl;
	}
	return 0;
}
