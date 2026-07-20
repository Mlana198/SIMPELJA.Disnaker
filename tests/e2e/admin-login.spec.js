import { test, expect } from "@playwright/test";
import { loginAsAdmin, logoutFrom } from "./utils/auth";

test.describe("SIM-PELJA admin flow", () => {
    test("admin can login and access the dashboard", async ({ page }) => {
        await loginAsAdmin(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({
            timeout: 15000,
        });
    });

    test("admin can open the user management page", async ({ page }) => {
        await loginAsAdmin(page);

        await page.goto("/admin/manajemen-pengguna");
        await page.waitForURL(/\/admin\/manajemen-pengguna(?:\/)?/);
        await expect(page).toHaveURL(/\/admin\/manajemen-pengguna(?:\/)?/);

        await expect(
            page.getByRole("heading", { name: "Pengguna", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });

    test("admin can login and logout successfully", async ({ page }) => {
        await loginAsAdmin(page);
        await logoutFrom(page);
    });

    test("invalid credentials show an error message", async ({ page }) => {
        await page.goto("/login");

        await page.locator('input[name="identity"]').fill("wrong-identity");
        await page.locator('input[name="email"]').fill("wrong@email.com");
        await page.locator('input[name="password"]').fill("wrong-password");

        await page.getByRole("button", { name: /^Login$/i }).click();

        await expect(
            page.getByText("Identitas atau Email tidak cocok."),
        ).toBeVisible({ timeout: 10000 });
        await expect(page).toHaveURL(/\/login/);
    });
});
