// ====== Helpers: storage & UI ======
const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

const storage = {
  get(key, fallback) {
    try { return JSON.parse(localStorage.getItem(key)) ?? fallback; }
    catch { return fallback; }
  },
  set(key, val) { localStorage.setItem(key, JSON.stringify(val)); },
  del(key) { localStorage.removeItem(key); }
};

const toast = (msg, type = 'success') => {
  const box = $('#toaster');
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.textContent = msg;
  box.appendChild(el);
  setTimeout(() => el.remove(), 2500);
};

// ====== Seed Data (RD sample) ======
const seed = () => {
  if (!storage.get('seeded')) {
    const provinces = [
      { id: 'DN', name: 'Distrito Nacional' },
      { id: 'SD', name: 'Santo Domingo' },
      { id: 'ST', name: 'Santiago' },
      { id: 'LR', name: 'La Romana' },
      { id: 'LV', name: 'La Vega' },
      { id: 'PP', name: 'Puerto Plata' },
    ];

    const municipalities = [
      { id: 'DN-SDG', name: 'Santo Domingo de Guzmán', provinceId: 'DN' },
      { id: 'SD-SDE', name: 'Santo Domingo Este', provinceId: 'SD' },
      { id: 'SD-SDO', name: 'Santo Domingo Oeste', provinceId: 'SD' },
      { id: 'SD-SDN', name: 'Santo Domingo Norte', provinceId: 'SD' },
      { id: 'SD-BC',  name: 'Boca Chica', provinceId: 'SD' },
      { id: 'ST-STC', name: 'Santiago de los Caballeros', provinceId: 'ST' },
      { id: 'LR-LR',  name: 'La Romana', provinceId: 'LR' },
      { id: 'LV-LV',  name: 'La Vega', provinceId: 'LV' },
      { id: 'PP-PP',  name: 'Puerto Plata', provinceId: 'PP' },
    ];

    const neighborhoods = [
      { id: 'DN-NAC', name: 'Naco', municipalityId: 'DN-SDG' },
      { id: 'DN-PIA', name: 'Piantini', municipalityId: 'DN-SDG' },
      { id: 'DN-GAZ', name: 'Gazcue', municipalityId: 'DN-SDG' },
      { id: 'SDE-ARO', name: 'Alma Rosa', municipalityId: 'SD-SDE' },
      { id: 'SDE-EOZ', name: 'Ensanche Ozama', municipalityId: 'SD-SDE' },
      { id: 'SDN-VM',  name: 'Villa Mella', municipalityId: 'SD-SDN' },
      { id: 'SDO-HER', name: 'Herrera', municipalityId: 'SD-SDO' },
      { id: 'STC-CC',  name: 'Centro Ciudad', municipalityId: 'ST-STC' },
      { id: 'LR-CENT', name: 'Centro', municipalityId: 'LR-LR' },
      { id: 'LV-CC',   name: 'Centro', municipalityId: 'LV-LV' },
      { id: 'PP-MAL',  name: 'Malecón', municipalityId: 'PP-PP' },
    ];

    const types = [
      { id: 'ACC', name: 'Accidente' },
      { id: 'PEL', name: 'Pelea' },
      { id: 'ROB', name: 'Robo' },
      { id: 'DES', name: 'Desastre' },
    ];

    const incidents = [
      {
        id: crypto.randomUUID(),
        date: new Date().toISOString().slice(0,10),
        title: 'Colisión vehículo-motocicleta',
        typeIds: ['ACC'],
        desc: 'Choque leve sin involucrar más vehículos.',
        provinceId: 'SD',
        municipalityId: 'SD-SDE',
        neighborhoodId: 'SDE-ARO',
        lat: 18.4861, lng: -69.8570,
        dead: 0, injured: 1, loss: 50000,
        link: 'https://example.com/incidente1',
        photo: null,
        state: 'Abierto'
      }
    ];

    storage.set('provinces', provinces);
    storage.set('municipalities', municipalities);
    storage.set('neighborhoods', neighborhoods);
    storage.set('types', types);
    storage.set('incidents', incidents);

    storage.set('seeded', true);
  }
};
seed();

// ====== Auth (mock) ======
const auth = {
  user() { return storage.get('auth_user', null); },
  login(email, password) {
    if (!email || !password) return false;
    const user = storage.get('users', []).find(u => u.email === email) || { name: 'Usuario', email };
    storage.set('auth_user', user);
    return true;
  },
  register(name, email, password) {
    const users = storage.get('users', []);
    if (users.some(u => u.email === email)) throw new Error('Este correo ya está registrado.');
    users.push({ name, email });
    storage.set('users', users);
    storage.set('auth_user', { name, email });
  },
  logout() { storage.del('auth_user'); }
};

// ====== Router ======
const routes = ['#/login', '#/register', '#/dashboard', '#/incidents', '#/provinces', '#/municipalities', '#/neighborhoods', '#/types', '#/profile'];

function renderRoute() {
  const hash = location.hash || (auth.user() ? '#/dashboard' : '#/login');
  const current = routes.includes(hash) ? hash : '#/dashboard';

  // Auth gate
  if (!auth.user() && current !== '#/login' && current !== '#/register') {
    location.hash = '#/login';
    return;
  }
  // Toggle views
  $$('.view').forEach(v => v.classList.add('hidden'));
  const viewId = '#view-' + current.replace('#/','');
  $(viewId)?.classList.remove('hidden');

  // Active nav
  $$('.nav-link').forEach(a => a.classList.toggle('active', a.getAttribute('data-route') === current));

  // Per-view renders
  if (current === '#/dashboard') renderDashboard();
  if (current === '#/incidents') renderIncidents();
  if (current === '#/provinces') renderProvinces();
  if (current === '#/municipalities') renderMunicipalities();
  if (current === '#/neighborhoods') renderNeighborhoods();
  if (current === '#/types') renderTypes();
  if (current === '#/profile') renderProfile();
}

window.addEventListener('hashchange', renderRoute);
document.addEventListener('DOMContentLoaded', () => {
  bindGlobal();
  renderRoute();
});

// ====== Global bindings ======
function bindGlobal() {
  // Navbar links
  $$('.nav-link').forEach(a => a.addEventListener('click', (e) => {
    e.preventDefault();
    location.hash = a.getAttribute('data-route');
  }));

  // Theme
  $('#btnTheme').addEventListener('click', () => {
    document.body.classList.toggle('light');
    storage.set('pref_theme_light', document.body.classList.contains('light'));
  });
  if (storage.get('pref_theme_light', false)) document.body.classList.add('light');

  // Auth buttons
  $('#btnLogout').addEventListener('click', () => {
    auth.logout();
    location.hash = '#/login';
  });

  // Login
  $('#formLogin')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = $('#loginEmail').value.trim();
    const pwd = $('#loginPassword').value.trim();
    if (!email || !pwd) return showErrors(e.target);
    auth.login(email, pwd);
    toast('Bienvenido');
    location.hash = '#/dashboard';
  });

  // Register
  $('#formRegister')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = $('#regName').value.trim();
    const email = $('#regEmail').value.trim();
    const pwd = $('#regPassword').value.trim();
    if (!name || !email || !pwd) return showErrors(e.target);
    try {
      auth.register(name, email, pwd);
      toast('Cuenta creada');
      location.hash = '#/dashboard';
    } catch (err) { toast(err.message, 'danger'); }
  });

  // Profile
  $('#formProfile')?.addEventListener('submit', (e) => {
    e.preventDefault();
    const user = { name: $('#profileName').value.trim(), email: $('#profileEmail').value.trim() };
    if (!user.name || !user.email) return showErrors(e.target);
    storage.set('auth_user', user);
    // update in users list
    const users = storage.get('users', []);
    const i = users.findIndex(u => u.email === user.email);
    if (i >= 0) users[i] = user; else users.push(user);
    storage.set('users', users);
    toast('Perfil guardado');
  });
}

// ====== Validation helper ======
function showErrors(form) {
  $$('input, select, textarea', form).forEach(el => {
    const err = el.parentElement.querySelector('.error');
    if (!err) return;
    if (el.validity.valid) err.textContent = '';
    else if (el.validity.valueMissing) err.textContent = 'Campo requerido';
    else if (el.validity.typeMismatch) err.textContent = 'Formato inválido';
    else if (el.validity.tooShort) err.textContent = `Mínimo ${el.minLength} caracteres`;
    else err.textContent = 'Revisa este campo';
  });
}

// ====== Dashboard ======
function renderDashboard() {
  const incidents = storage.get('incidents', []);
  const types = storage.get('types', []);
  const locations = new Set(incidents.map(i => `${i.provinceId}|${i.municipalityId}|${i.neighborhoodId}`));

  $('#kpiIncidents').textContent = incidents.length;
  $('#kpiTypes').textContent = types.length;
  $('#kpiLocations').textContent = locations.size;

  const tbody = $('#tableLatest tbody');
  tbody.innerHTML = incidents.slice(-5).reverse().map(i => `
    <tr>
      <td>${i.date}</td>
      <td>${i.title}</td>
      <td>${i.typeIds.map(id => getType(id)?.name).join(', ')}</td>
      <td>${getProvince(i.provinceId)?.name ?? ''}</td>
      <td>${getMunicipality(i.municipalityId)?.name ?? ''}</td>
      <td>${i.state ?? 'Abierto'}</td>
    </tr>
  `).join('');
}

// ====== Helpers for data lookups ======
const getProvince = (id) => storage.get('provinces', []).find(p => p.id === id);
const getMunicipality = (id) => storage.get('municipalities', []).find(m => m.id === id);
const getNeighborhood = (id) => storage.get('neighborhoods', []).find(b => b.id === id);
const getType = (id) => storage.get('types', []).find(t => t.id === id);

// ====== Incidents View ======
function renderIncidents() {
  // Populate filters
  fillSelect($('#fltProvince'), storage.get('provinces', []), 'id', 'name', true);
  fillSelect($('#fltType'), storage.get('types', []), 'id', 'name', true);
  // Dynamic municipalities based on province filter
  $('#fltProvince').addEventListener('change', () => {
    const pid = $('#fltProvince').value;
    const muns = storage.get('municipalities', []).filter(m => !pid || m.provinceId === pid);
    fillSelect($('#fltMunicipality'), muns, 'id', 'name', true);
    renderIncidentTable();
  });
  $('#fltMunicipality').addEventListener('change', renderIncidentTable);
  $('#fltType').addEventListener('change', renderIncidentTable);
  $('#fltSearch').addEventListener('input', renderIncidentTable);

  // Initial fills
  $('#fltProvince').dispatchEvent(new Event('change'));

  // New incident
  $('#btnNewIncident').onclick = openIncidentModal;

  renderIncidentTable();
}

function renderIncidentTable() {
  const incidents = storage.get('incidents', []);
  const pid = $('#fltProvince').value;
  const mid = $('#fltMunicipality').value;
  const tid = $('#fltType').value;
  const q = ($('#fltSearch').value || '').toLowerCase();

  const filtered = incidents.filter(i => {
    return (!pid || i.provinceId === pid)
      && (!mid || i.municipalityId === mid)
      && (!tid || i.typeIds.includes(tid))
      && (!q || i.title.toLowerCase().includes(q) || (i.desc||'').toLowerCase().includes(q));
  });

  const tbody = $('#tableIncidents tbody');
  tbody.innerHTML = filtered.map(i => `
    <tr>
      <td>${i.date}</td>
      <td>${i.title}</td>
      <td>${i.typeIds.map(id => getType(id)?.name).join(', ')}</td>
      <td>${getProvince(i.provinceId)?.name ?? ''}</td>
      <td>${getMunicipality(i.municipalityId)?.name ?? ''}</td>
      <td>${i.dead ?? 0}</td>
      <td>${i.injured ?? 0}</td>
      <td>${(i.loss??0).toLocaleString('es-DO')}</td>
      <td class="actions">
        <button class="icon-btn" title="Editar" onclick="editIncident('${i.id}')">✏️</button>
        <button class="icon-btn" title="Eliminar" onclick="deleteIncident('${i.id}')">🗑️</button>
      </td>
    </tr>
  `).join('');
}

// ====== Incident Modal ======
let editingIncidentId = null;

function openIncidentModal() {
  editingIncidentId = null;
  $('#incidentTitle').textContent = 'Nueva Incidencia';
  fillIncidentSelectors();
  $('#formIncident').reset();
  $('#incPhotoPreview').style.backgroundImage = '';
  $('#dlgIncident').showModal();
}

function fillIncidentSelectors(inc = null) {
  // Types (multi)
  fillSelect($('#incTypes'), storage.get('types', []), 'id', 'name', false);
  // Province / Municipality / Neighborhood linked
  const provinces = storage.get('provinces', []);
  fillSelect($('#incProvince'), provinces, 'id', 'name', false);

  const setMun = () => {
    const pid = $('#incProvince').value;
    const muns = storage.get('municipalities', []).filter(m => m.provinceId === pid);
    fillSelect($('#incMunicipality'), muns, 'id', 'name', false);
    setBarrio();
  };
  const setBarrio = () => {
    const mid = $('#incMunicipality').value;
    const barrios = storage.get('neighborhoods', []).filter(b => b.municipalityId === mid);
    fillSelect($('#incNeighborhood'), barrios, 'id', 'name', false);
  };

  $('#incProvince').onchange = setMun;
  $('#incMunicipality').onchange = setBarrio;

  if (inc) {
    $('#incDate').value = inc.date;
    $('#incTitle').value = inc.title;
    $('#incDesc').value = inc.desc || '';
    $('#incDead').value = inc.dead ?? 0;
    $('#incInjured').value = inc.injured ?? 0;
    $('#incLoss').value = inc.loss ?? 0;
    $('#incLink').value = inc.link || '';
    $('#incLat').value = inc.lat ?? '';
    $('#incLng').value = inc.lng ?? '';
    $('#incProvince').value = inc.provinceId;
    setMun();
    $('#incMunicipality').value = inc.municipalityId;
    setBarrio();
    $('#incNeighborhood').value = inc.neighborhoodId;
    // types multi
    $$('#incTypes option').forEach(o => o.selected = inc.typeIds.includes(o.value));
    // photo preview
    if (inc.photo) $('#incPhotoPreview').style.backgroundImage = `url(${inc.photo})`;
  } else {
    // Defaults
    $('#incDate').valueAsDate = new Date();
    $('#incProvince').value = provinces[0]?.id || '';
    setMun();
  }

  // Photo preview
  $('#incPhoto').onchange = async (e) => {
    const file = e.target.files[0];
    if (!file) { $('#incPhotoPreview').style.backgroundImage = ''; return; }
    const dataUrl = await fileToDataURL(file);
    $('#incPhotoPreview').style.backgroundImage = `url(${dataUrl})`;
    $('#incPhoto').dataset.dataurl = dataUrl;
  };

  // Close buttons
  $$('[data-close]', $('#dlgIncident')).forEach(b => b.onclick = () => $('#dlgIncident').close());
}

function editIncident(id) {
  const inc = storage.get('incidents', []).find(x => x.id === id);
  if (!inc) return;
  editingIncidentId = id;
  $('#incidentTitle').textContent = 'Editar Incidencia';
  fillIncidentSelectors(inc);
  $('#dlgIncident').showModal();
}

function deleteIncident(id) {
  const list = storage.get('incidents', []);
  const idx = list.findIndex(i => i.id === id);
  if (idx < 0) return;
  list.splice(idx,1);
  storage.set('incidents', list);
  toast('Incidencia eliminada');
  renderIncidents(); renderDashboard();
}

$('#formIncident').addEventListener('submit', (e) => {
  e.preventDefault();
  const form = e.target;
  // Basic required validations
  const required = ['incDate','incTitle','incProvince','incMunicipality','incNeighborhood'];
  let ok = true;
  required.forEach(id => {
    const el = document.getElementById(id);
    if (!el.value) ok = false;
  });
  if (!ok) { showErrors(form); return; }

  const selectedTypes = $$('#incTypes option').filter(o => o.selected).map(o => o.value);
  if (selectedTypes.length === 0) { toast('Selecciona al menos un tipo', 'danger'); return; }

  const inc = {
    id: editingIncidentId || crypto.randomUUID(),
    date: $('#incDate').value,
    title: $('#incTitle').value.trim(),
    typeIds: selectedTypes,
    desc: $('#incDesc').value.trim(),
    provinceId: $('#incProvince').value,
    municipalityId: $('#incMunicipality').value,
    neighborhoodId: $('#incNeighborhood').value,
    lat: parseFloat($('#incLat').value) || null,
    lng: parseFloat($('#incLng').value) || null,
    dead: parseInt($('#incDead').value || '0', 10),
    injured: parseInt($('#incInjured').value || '0', 10),
    loss: parseInt($('#incLoss').value || '0', 10),
    link: $('#incLink').value.trim() || null,
    photo: $('#incPhoto').dataset.dataurl || null,
    state: 'Abierto'
  };

  const list = storage.get('incidents', []);
  const idx = list.findIndex(i => i.id === inc.id);
  if (idx >= 0) list[idx] = inc; else list.push(inc);
  storage.set('incidents', list);
  $('#dlgIncident').close();
  toast('Incidencia guardada');
  renderIncidents(); renderDashboard();
});

async function fileToDataURL(file) {
  return new Promise((resolve, reject) => {
    const r = new FileReader();
    r.onload = () => resolve(r.result);
    r.onerror = reject;
    r.readAsDataURL(file);
  });
}

// ====== CRUD: Provinces, Municipalities, Neighborhoods, Types ======
function renderProvinces() {
  const tbody = $('#tableProvinces tbody');
  const list = storage.get('provinces', []);
  tbody.innerHTML = list.map(p => `
    <tr>
      <td>${p.name}</td>
      <td class="actions">
        <button class="icon-btn" onclick="editItem('province','${p.id}','Nombre de la provincia')">✏️</button>
        <button class="icon-btn" onclick="deleteItem('province','${p.id}')">🗑️</button>
      </td>
    </tr>`).join('');

  $('#btnNewProvince').onclick = () => newItem('province', 'Nombre de la provincia');
}

function renderMunicipalities() {
  const provinces = storage.get('provinces', []);
  fillSelect($('#selProvinceForMunicipio'), provinces, 'id', 'name', true);

  const refresh = () => {
    const pid = $('#selProvinceForMunicipio').value;
    const list = storage.get('municipalities', []).filter(m => !pid || m.provinceId === pid);
    const tbody = $('#tableMunicipalities tbody');
    tbody.innerHTML = list.map(m => `
      <tr>
        <td>${m.name}</td>
        <td>${getProvince(m.provinceId)?.name ?? ''}</td>
        <td class="actions">
          <button class="icon-btn" onclick="editItem('municipality','${m.id}','Nombre del municipio','${m.provinceId}')">✏️</button>
          <button class="icon-btn" onclick="deleteItem('municipality','${m.id}')">🗑️</button>
        </td>
      </tr>
    `).join('');
  };

  $('#selProvinceForMunicipio').onchange = refresh;
  refresh();

  $('#btnNewMunicipality').onclick = () => newItem('municipality', 'Nombre del municipio');
}

function renderNeighborhoods() {
  const provinces = storage.get('provinces', []);
  fillSelect($('#selProvinceForBarrio'), provinces, 'id', 'name', true);

  const setMuns = () => {
    const pid = $('#selProvinceForBarrio').value;
    const muns = storage.get('municipalities', []).filter(m => !pid || m.provinceId === pid);
    fillSelect($('#selMunicipioForBarrio'), muns, 'id', 'name', true);
    refresh();
  };
  $('#selProvinceForBarrio').onchange = setMuns;
  $('#selMunicipioForBarrio').onchange = refresh;
  setMuns();

  function refresh() {
    const pid = $('#selProvinceForBarrio').value;
    const mid = $('#selMunicipioForBarrio').value;
    const list = storage.get('neighborhoods', []).filter(b => (!mid || b.municipalityId === mid) && (!pid || getMunicipality(b.municipalityId)?.provinceId === pid));
    const tbody = $('#tableNeighborhoods tbody');
    tbody.innerHTML = list.map(b => {
      const mun = getMunicipality(b.municipalityId);
      return `<tr>
        <td>${b.name}</td>
        <td>${mun?.name ?? ''}</td>
        <td>${getProvince(mun?.provinceId)?.name ?? ''}</td>
        <td class="actions">
          <button class="icon-btn" onclick="editItem('neighborhood','${b.id}','Nombre del barrio','${b.municipalityId}')">✏️</button>
          <button class="icon-btn" onclick="deleteItem('neighborhood','${b.id}')">🗑️</button>
        </td>
      </tr>`;
    }).join('');
  }

  $('#btnNewNeighborhood').onclick = () => newItem('neighborhood', 'Nombre del barrio');
}

function renderTypes() {
  const tbody = $('#tableTypes tbody');
  const list = storage.get('types', []);
  tbody.innerHTML = list.map(t => `
    <tr>
      <td>${t.name}</td>
      <td class="actions">
        <button class="icon-btn" onclick="editItem('type','${t.id}','Nombre del tipo')">✏️</button>
        <button class="icon-btn" onclick="deleteItem('type','${t.id}')">🗑️</button>
      </td>
    </tr>`).join('');

  $('#btnNewType').onclick = () => newItem('type', 'Nombre del tipo');
}

// Generic CRUD handlers using simple dialog
const dlg = $('#dlgSimple');
const dlgTitle = $('#dlgSimpleTitle');
const dlgLabel = $('#dlgLabel');
const dlgInput = $('#dlgInput');
const dlgOk = $('#dlgOk');

let editContext = null;

function newItem(kind, label) {
  editContext = { kind, id: null, extraId: null };
  dlgTitle.textContent = 'Nuevo';
  dlgLabel.textContent = label;
  dlgInput.value = '';
  dlg.showModal();
}
function editItem(kind, id, label, extraId = null) {
  editContext = { kind, id, extraId };
  dlgTitle.textContent = 'Editar';
  dlgLabel.textContent = label;
  // preload value
  const map = {
    province: () => storage.get('provinces', []).find(x => x.id === id)?.name || '',
    municipality: () => storage.get('municipalities', []).find(x => x.id === id)?.name || '',
    neighborhood: () => storage.get('neighborhoods', []).find(x => x.id === id)?.name || '',
    type: () => storage.get('types', []).find(x => x.id === id)?.name || ''
  };
  dlgInput.value = (map[kind] ? map[kind]() : '');
  dlg.showModal();
}
function deleteItem(kind, id) {
  const map = {
    province: () => {
      // also cascade delete municipalities and neighborhoods?
      const provinces = storage.get('provinces', []).filter(x => x.id !== id);
      const municipalities = storage.get('municipalities', []).filter(m => m.provinceId !== id);
      const remainingMunIds = new Set(municipalities.map(m => m.id));
      const neighborhoods = storage.get('neighborhoods', []).filter(b => remainingMunIds.has(b.municipalityId));
      storage.set('provinces', provinces);
      storage.set('municipalities', municipalities);
      storage.set('neighborhoods', neighborhoods);
      renderProvinces(); renderMunicipalities(); renderNeighborhoods(); renderIncidents();
    },
    municipality: () => {
      const municipalities = storage.get('municipalities', []).filter(m => m.id !== id);
      const neighborhoods = storage.get('neighborhoods', []).filter(b => b.municipalityId !== id);
      storage.set('municipalities', municipalities);
      storage.set('neighborhoods', neighborhoods);
      renderMunicipalities(); renderNeighborhoods(); renderIncidents();
    },
    neighborhood: () => {
      const neighborhoods = storage.get('neighborhoods', []).filter(b => b.id !== id);
      storage.set('neighborhoods', neighborhoods);
      renderNeighborhoods(); renderIncidents();
    },
    type: () => {
      const types = storage.get('types', []).filter(t => t.id !== id);
      storage.set('types', types);
      renderTypes(); renderIncidents();
    }
  };
  map[kind] && map[kind]();
  toast('Eliminado');
}

// Dialog OK
dlgOk.addEventListener('click', (e) => {
  e.preventDefault();
  const name = dlgInput.value.trim();
  if (!name) { toast('Nombre requerido', 'danger'); return; }

  const idFrom = (prefix, label) => (prefix + '-' + label.toUpperCase().replace(/\s+/g,'').slice(0,6));

  if (editContext.kind === 'province') {
    const list = storage.get('provinces', []);
    if (editContext.id) {
      const idx = list.findIndex(x => x.id === editContext.id);
      list[idx].name = name;
    } else {
      list.push({ id: idFrom('P', name), name });
    }
    storage.set('provinces', list);
    renderProvinces();
  }

  if (editContext.kind === 'municipality') {
    const list = storage.get('municipalities', []);
    if (editContext.id) {
      const idx = list.findIndex(x => x.id === editContext.id);
      list[idx].name = name;
    } else {
      // ask province via prompt (simple for prototype)
      const provinceId = prompt('ID de la provincia (ej: SD)') || storage.get('provinces', [])[0]?.id;
      list.push({ id: idFrom('M', name), name, provinceId });
    }
    storage.set('municipalities', list);
    renderMunicipalities();
  }

  if (editContext.kind === 'neighborhood') {
    const list = storage.get('neighborhoods', []);
    if (editContext.id) {
      const idx = list.findIndex(x => x.id === editContext.id);
      list[idx].name = name;
    } else {
      const municipalityId = prompt('ID del municipio (ej: SD-SDE)') || storage.get('municipalities', [])[0]?.id;
      list.push({ id: idFrom('B', name), name, municipalityId });
    }
    storage.set('neighborhoods', list);
    renderNeighborhoods();
  }

  if (editContext.kind === 'type') {
    const list = storage.get('types', []);
    if (editContext.id) {
      const idx = list.findIndex(x => x.id === editContext.id);
      list[idx].name = name;
    } else {
      list.push({ id: idFrom('T', name), name });
    }
    storage.set('types', list);
    renderTypes();
  }

  dlg.close();
  toast('Guardado');
});

// Close dialog
$$('[data-close]', dlg).forEach(b => b.onclick = () => dlg.close());

// ====== Profile ======
function renderProfile() {
  const user = auth.user() || { name: '', email: '' };
  $('#profileName').value = user.name || '';
  $('#profileEmail').value = user.email || '';
}

// ====== Utilities ======
function fillSelect(sel, items, valueKey, labelKey, includeAll) {
  sel.innerHTML = '';
  if (includeAll) sel.appendChild(new Option('Todos', ''));
  items.forEach(it => sel.appendChild(new Option(it[labelKey], it[valueKey])));
}
