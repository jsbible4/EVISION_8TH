#include <stdio.h>

int main(void) {
    int a, b;
    printf("Enter two numbers: ");
    scanf("%d %d", &a, &b);

    if (a + b == 42)
        puts("Correct");
    else
        puts("Wrong");

    return 0;
}
