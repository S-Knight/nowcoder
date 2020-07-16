package com.igeekspace;

import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        while (scanner.hasNextInt()) {
            int n;
            n = scanner.nextInt();

            //存储数组元素
            int[] nums = new int[n];
            for (int i = 0; i < n; i++) {
                nums[i] = scanner.nextInt();
            }

            //记录以aj为末尾元素的连续子数组的最大和
            int[] maxSums = new int[n];
            maxSums[0] = nums[0];

            int max = maxSums[0];
            for (int i = 1; i < n; i++) {
                maxSums[i] = maxSums[i - 1] < 0 ? nums[i] : maxSums[i - 1] + nums[i];
                max = Math.max(maxSums[i], max);
            }

            System.out.println(max);
        }
    }
}