#include <iostream>
#include <cmath>
using namespace std;

int main() {
	int arr[100];
	int i,j,n,m,mx=0;
	cin >> n >> m;
	for (i=0; i<n; i++) {
		mx = 0;
		for (j=0; j<m; j++) {
			cin >> arr[j];
			if (fabs(arr[j]) > mx) mx=fabs(arr[j]);
		}
		for (j=0; j<m; j++) {
			if (fabs(arr[j]) == mx) arr[j] = -1 * arr[j];
		}
		for (j=0; j<m-1; j++) {
			cout << arr[j] << " ";
		}
		cout << arr[m-1] << endl;
	}
	return 0;
}
