#include <stdio.h>

int main(void)
{
    int t, p, h;
    int n, m, l;
    
    for(n = 1001; n < 3000; n ++)
    {
        for(m = 1001; m < 3000; m ++)
        {
            for(l = 1001; l < 3000; l ++)
            {
                t = (n * (n + 1)) / 2;
                p = (m * (3 * m - 1)) / 2;
                h = (l * (2 * l - 1));
                
                if (t == p && p == h)
                {
                    printf("%d\n", t);
                    break;
                }
            }
        }
    }
    return 0;
}
