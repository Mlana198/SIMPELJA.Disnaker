import { test, expect } from "@playwright/test";
import { loginAsKabid } from "./utils/auth";

test.describe("SIM-PELJA kabid flow", () => {
    test("kabid can login and access the dashboard", async ({ page }) => {
        await loginAsKabid(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });
});
