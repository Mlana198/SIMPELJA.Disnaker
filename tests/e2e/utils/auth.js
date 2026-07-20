import { expect } from "@playwright/test";

export const adminCredentials = {
    identity: "198905222015031002",
    email: "admin@simpelja.go.id",
    password: "password123",
};

export const pesertaCredentials = {
    identity: "3515061203990002",
    email: "budi.peserta@gmail.com",
    password: "password123",
};

export const kabidCredentials = {
    identity: "197001011996031001",
    email: "kabid@simpelja.go.id",
    password: "password123",
};

export const instrukturCredentials = {
    identity: "198203152010012003",
    email: "instruktur@simpelja.go.id",
    password: "password123",
};

export const subKoordinatorCredentials = {
    identity: "197611082002121001",
    email: "subkoor@simpelja.go.id",
    password: "password123",
};

export async function loginAsAdmin(page) {
    await page.goto("/login", { waitUntil: "domcontentloaded" });

    await expect(
        page.getByRole("heading", { name: "Login SIM-PELJA", exact: true }),
    ).toBeVisible();

    await page
        .locator('input[name="identity"]')
        .fill(adminCredentials.identity);
    await page.locator('input[name="email"]').fill(adminCredentials.email);
    await page
        .locator('input[name="password"]')
        .fill(adminCredentials.password);

    await page.getByRole("button", { name: /^Login$/i }).click();

    await page.waitForURL(/\/admin(?:\/)?/, { waitUntil: "domcontentloaded" });
    await expect(page).toHaveURL(/\/admin(?:\/)?/);
}

export async function loginAsPeserta(page) {
    await page.goto("/login", { waitUntil: "domcontentloaded" });

    await expect(
        page.getByRole("heading", { name: "Login SIM-PELJA", exact: true }),
    ).toBeVisible();

    await page
        .locator('input[name="identity"]')
        .fill(pesertaCredentials.identity);
    await page.locator('input[name="email"]').fill(pesertaCredentials.email);
    await page
        .locator('input[name="password"]')
        .fill(pesertaCredentials.password);

    await page.getByRole("button", { name: /^Login$/i }).click();

    await page.waitForURL(/\/peserta(?:\/)?/, {
        waitUntil: "domcontentloaded",
    });
    await expect(page).toHaveURL(/\/peserta(?:\/)?/);
}

export async function loginAsKabid(page) {
    await page.goto("/login", { waitUntil: "domcontentloaded" });

    await expect(
        page.getByRole("heading", { name: "Login SIM-PELJA", exact: true }),
    ).toBeVisible();

    await page
        .locator('input[name="identity"]')
        .fill(kabidCredentials.identity);
    await page.locator('input[name="email"]').fill(kabidCredentials.email);
    await page
        .locator('input[name="password"]')
        .fill(kabidCredentials.password);

    await page.getByRole("button", { name: /^Login$/i }).click();

    await page.waitForURL(/\/kabid(?:\/)?/, { waitUntil: "domcontentloaded" });
    await expect(page).toHaveURL(/\/kabid(?:\/)?/);
}

export async function loginAsInstruktur(page) {
    await page.goto("/login", { waitUntil: "domcontentloaded" });

    await expect(
        page.getByRole("heading", { name: "Login SIM-PELJA", exact: true }),
    ).toBeVisible();

    await page
        .locator('input[name="identity"]')
        .fill(instrukturCredentials.identity);
    await page.locator('input[name="email"]').fill(instrukturCredentials.email);
    await page
        .locator('input[name="password"]')
        .fill(instrukturCredentials.password);

    await page.getByRole("button", { name: /^Login$/i }).click();

    await page.waitForURL(/\/instruktur(?:\/)?/, {
        waitUntil: "domcontentloaded",
    });
    await expect(page).toHaveURL(/\/instruktur(?:\/)?/);
}

export async function loginAsSubKoordinator(page) {
    await page.goto("/login", { waitUntil: "domcontentloaded" });

    await expect(
        page.getByRole("heading", { name: "Login SIM-PELJA", exact: true }),
    ).toBeVisible();

    await page
        .locator('input[name="identity"]')
        .fill(subKoordinatorCredentials.identity);
    await page
        .locator('input[name="email"]')
        .fill(subKoordinatorCredentials.email);
    await page
        .locator('input[name="password"]')
        .fill(subKoordinatorCredentials.password);

    await page.getByRole("button", { name: /^Login$/i }).click();

    await page.waitForURL(/\/subkoordinator(?:\/)?/, {
        waitUntil: "domcontentloaded",
    });
    await expect(page).toHaveURL(/\/subkoordinator(?:\/)?/);
}

export async function loginAsRole(page, roleName) {
    const handlers = {
        admin: loginAsAdmin,
        peserta: loginAsPeserta,
        kabid: loginAsKabid,
        instruktur: loginAsInstruktur,
        subkoordinator: loginAsSubKoordinator,
    };

    const handler = handlers[roleName];

    if (!handler) {
        throw new Error(`Unsupported role: ${roleName}`);
    }

    await handler(page);
}

export async function registerParticipant(page, overrides = {}) {
    const userData = {
        nama_lengkap: "User Baru Playwright",
        nomor_identitas: `999${Date.now().toString().slice(-10)}`,
        email: `playwright-${Date.now()}@example.com`,
        password: "password123",
        ...overrides,
    };

    await page.goto("/register", { waitUntil: "domcontentloaded" });

    await expect(
        page.getByRole("heading", { name: "Daftar Akun Baru", exact: true }),
    ).toBeVisible();

    await page
        .locator('input[name="nama_lengkap"]')
        .fill(userData.nama_lengkap);
    await page
        .locator('input[name="nomor_identitas"]')
        .fill(userData.nomor_identitas);
    await page.locator('input[name="email"]').fill(userData.email);
    await page.locator('input[name="password"]').fill(userData.password);
    await page
        .locator('input[name="password_confirmation"]')
        .fill(userData.password);

    await page.getByRole("button", { name: /^Daftar Sekarang$/i }).click();

    await page.waitForURL(/\/peserta(?:\/)?/, {
        waitUntil: "domcontentloaded",
    });
    await expect(page).toHaveURL(/\/peserta(?:\/)?/);

    return userData;
}

export async function logoutFrom(page) {
    const logoutButton = page.getByRole("button", { name: "Keluar" });

    await expect(logoutButton).toBeVisible();

    await logoutButton.click();

    await page.waitForLoadState("networkidle");
}
