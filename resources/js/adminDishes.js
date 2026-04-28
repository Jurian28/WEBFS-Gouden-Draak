const csrfMeta = document.querySelector('meta[name="csrf-token"]');

const csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';

async function request(url, method, data = null) {
    const res = await fetch(url, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: data ? JSON.stringify(data) : null,
    });

    return res;
}

document.addEventListener('click', async (e) => {

    const action = e.target.dataset.action;
    if (!action) return;

    // =====================
    // SAVE DISH
    // =====================
    if (action === 'save-dish') {
        const row = e.target.closest('tr');
        const id = row.dataset.id;

        const data = {
            menu_number: row.querySelector('[name="menu_number"]')?.value || null,
            menu_affix: row.querySelector('[name="menu_affix"]')?.value || null,
            name: row.querySelector('[name="name"]')?.value || '',
            price: row.querySelector('[name="price"]')?.value || 0,
            dish_type_id: row.querySelector('[name="dish_type_id"]')?.value,
        };

        await request(`/admin/dishes/${id}`, 'PUT', data);

        e.target.textContent = 'Saved!';
        setTimeout(() => e.target.textContent = 'Save', 1000);
    }

    // =====================
    // DELETE DISH
    // =====================
    if (action === 'delete-dish') {
        const row = e.target.closest('tr');
        const id = row.dataset.id;

        if (!confirm('Delete this dish?')) return;

        await request(`/admin/dishes/${id}`, 'DELETE');
        row.remove();
    }

    // =====================
    // CREATE DISH
    // =====================
    if (action === 'create-dish') {
        const row = e.target.closest('tr');

        const data = {
            menu_number: row.querySelector('[name="new_menu_number"]').value,
            menu_affix: row.querySelector('[name="new_menu_affix"]').value,
            name: row.querySelector('[name="new_name"]').value,
            dish_type_id: row.querySelector('[name="new_dish_type_id"]').value,
            price: row.querySelector('[name="new_price"]').value,
        };

        if (!data.name) return alert('Name required');

        await request('/admin/dishes', 'POST', data);
        location.reload();
    }

    // =====================
    // SAVE TYPE
    // =====================
    if (action === 'save-type') {
        const row = e.target.closest('tr');
        const id = row.dataset.id;

        const data = {
            name: row.querySelector('[name="name"]')?.value || '',
            order: row.querySelector('[name="order"]')?.value || 0,
        };

        await request(`/admin/dish-types/${id}`, 'PUT', data);

        e.target.textContent = 'Saved!';
        setTimeout(() => e.target.textContent = 'Save', 1000);
    }

    // =====================
    // DELETE TYPE
    // =====================
    if (action === 'delete-type') {
        const row = e.target.closest('tr');
        const id = row.dataset.id;

        if (!confirm('Delete this type?')) return;

        await request(`/admin/dish-types/${id}`, 'DELETE');
        row.remove();
    }

    // =====================
    // CREATE TYPE
    // =====================
    if (action === 'create-type') {
        const row = e.target.closest('tr');

        const data = {
            name: row.querySelector('[name="new_type_name"]').value,
            order: row.querySelector('[name="new_order"]').value || 0,
        };

        if (!data.name) return alert('Name required');

        await request('/admin/dish-types', 'POST', data);
        location.reload();
    }
});
