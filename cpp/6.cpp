#include <iostream>
using namespace std;

int main()
{
int mas[40][40];
int i,j,m,n,w,k;
cin >> n >> m;
cin >> w;
for (i=0; i<40; i++) for (j=0; j<40; j++) mas[i][j]=0; 
for (k=0; k<w; k++) { cin >> i >> j; mas[i][j]=-1; }
for (i=1; i<=n; i++)
 {
  for (j=1; j<=m; j++)
   {
    if (mas[i][j]!=-1)
     {
      k=0;
      if (mas[i-1][j]==-1) k++;
      if (mas[i][j-1]==-1) k++;
      if (mas[i-1][j-1]==-1) k++;
      if (mas[i+1][j]==-1) k++;
      if (mas[i][j+1]==-1) k++;
      if (mas[i+1][j+1]==-1) k++;
      if (mas[i-1][j+1]==-1) k++;
      if (mas[i+1][j-1]==-1) k++;
      mas[i][j]=k;
     }
   }
 }
 for (i=1; i<=n; i++) { for (j=1; j<m; j++) { if (mas[i][j]==-1) cout << "* "; else cout << mas[i][j] << " "; }
 if (mas[i][m]==-1) cout << "*\n"; else cout << mas[i][m]<<endl; }
 return 0;
}  
