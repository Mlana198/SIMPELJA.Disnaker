import { test, expect } from "@playwright/test";
import { registerParticipant } from "./utils/auth";

test.describe("SIM-PELJA registration flow", () => {
    test("from landing page, new participant can go to register and land on the peserta dashboard", async ({
        page,
    }) => {
        await page.goto("/", { waitUntil: "domcontentloaded" });
        await page.getByRole("link", { name: /Masuk \/ Daftar/i }).click();

        await expect(
            page.getByRole("heading", { name: "Login SIM-PELJA", exact: true }),
        ).toBeVisible({ timeout: 15000 });

        await page.getByRole("link", { name: /Daftar di sini/i }).click();

        await expect(
            page.getByRole("heading", {
                name: "Daftar Akun Baru",
                exact: true,
            }),
        ).toBeVisible({ timeout: 15000 });

        await registerParticipant(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });

    test("new participant can register and land on the peserta dashboard", async ({
        page,
    }) => {
        await registerParticipant(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });
});
