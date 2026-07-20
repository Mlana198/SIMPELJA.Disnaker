import { test, expect } from "@playwright/test";
import { loginAsInstruktur } from "./utils/auth";

test.describe("SIM-PELJA instruktur flow", () => {
    test("instruktur can login and access the dashboard", async ({ page }) => {
        await loginAsInstruktur(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });
});
