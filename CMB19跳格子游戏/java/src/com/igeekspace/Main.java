package com.igeekspace;

import java.util.Scanner;

public class Main {
    /**
     * 计算跳完n 个格子的方法数量
     *
     * @param n 格子数
     * @return 跳完n 个格子的方法数量
     */
    private static int getWaysCount(int n) {
        int previous[] = new int[]{0, 1, 2};

        if (n < 3) {
            return previous[n];
        }

        int previousI = 0;
        for (int i = 3; i <= n; i++) {
            previousI = previous[1] + previous[2];
            previous[1] = previous[2];
            previous[2] = previousI;
        }
        return previousI;
    }

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        while (scanner.hasNextInt()) {
            int n = scanner.nextInt();

            System.out.println(getWaysCount(n));
        }
    }
}
