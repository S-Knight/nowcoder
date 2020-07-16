package com.igeekspace;

import java.util.Scanner;

public class Main {
    /**
     * 计算走到右下角的走法数量
     *
     * @param x 右下角x坐标
     * @param y 右下角y坐标
     * @return 走到右下角的走法数量
     */
    private static int getWaysCount(int x, int y) {
        int[][] ways = new int[y + 1][x + 1];

        ways[0][0] = 1;

        int temp = 0;
        for (int i = 0; i <= y; i++) {
            for (int j = 0; j <= x; j++) {
                if (i == 0 && j == 0) {
                    continue;
                }

                temp = 0;
                if (i - 1 >= 0) {
                    temp += ways[i - 1][j];
                }

                if (j - 1 >= 0) {
                    temp += ways[i][j - 1];
                }

                ways[i][j] = temp;
            }
        }

        return ways[y][x];
    }


    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        while (scanner.hasNextInt()) {
            int x, y;

            x = scanner.nextInt();
            y = scanner.nextInt();

            System.out.println(getWaysCount(x, y));
        }
    }
}
