import { test, expect } from "@playwright/test";
import { loginAsRole } from "./utils/auth";

const roles = [
    { name: "admin", path: "/admin", heading: "Dasbor" },
    { name: "peserta", path: "/peserta", heading: "Dasbor" },
    { name: "kabid", path: "/kabid", heading: "Dasbor" },
    { name: "instruktur", path: "/instruktur", heading: "Dasbor" },
    { name: "subkoordinator", path: "/subkoordinator", heading: "Dasbor" },
];

for (const role of roles) {
    test(`${role.name} can access the dashboard`, async ({ page }) => {
        await loginAsRole(page, role.name);

        await expect(page).toHaveURL(new RegExp(`${role.path}(?:/)?`));
        await expect(
            page.getByRole("heading", { name: role.heading, exact: true }),
        ).toBeVisible({ timeout: 15000 });
    });
}
