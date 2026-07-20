import { test, expect } from "@playwright/test";
import { loginAsSubKoordinator } from "./utils/auth";

test.describe("SIM-PELJA subkoordinator flow", () => {
    test("subkoordinator can login and access the dashboard", async ({
        page,
    }) => {
        await loginAsSubKoordinator(page);

        await expect(
            page.getByRole("heading", { name: "Dasbor", exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });
});
