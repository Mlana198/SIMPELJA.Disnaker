import { test, expect } from "@playwright/test";
import { loginAsPeserta, logoutFrom } from "./utils/auth";

test.describe("SIM-PELJA peserta flow", () => {
    test("peserta can login and access the dashboard", async ({ page }) => {
        await loginAsPeserta(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });

    test("peserta can open the training information page", async ({ page }) => {
        await loginAsPeserta(page);

        await page.goto("/peserta/informasi-pelatihan");
        await page.waitForURL(/\/peserta\/informasi-pelatihan(?:\/)?/);
        await expect(page).toHaveURL(/\/peserta\/informasi-pelatihan(?:\/)?/);

        await expect(
            page.getByRole("heading", {
                name: "Pelatihan",
                exact: true,
            }),
        ).toBeVisible({ timeout: 15000 });
    });

    test("peserta can open the profile page", async ({ page }) => {
        await loginAsPeserta(page);

        await page.goto("/peserta/my-profile");
        await page.waitForURL(/\/peserta\/my-profile(?:\/)?/);
        await expect(page).toHaveURL(/\/peserta\/my-profile(?:\/)?/);

        await expect(
            page.getByText("Kelengkapan Data Profil", { exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });

    test("peserta can login and logout successfully", async ({ page }) => {
        await loginAsPeserta(page);
        await logoutFrom(page);
    });
});
