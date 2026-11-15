const STORAGE_KEY = 'damnwear-route-history';
const MAX_ITEMS = 5;

export function readRouteHistory() {
  if (typeof window === 'undefined') {
    return [];
  }

  try {
    const parsed = JSON.parse(window.localStorage.getItem(STORAGE_KEY) || '[]');
    return Array.isArray(parsed) ? parsed : [];
  } catch (error) {
    return [];
  }
}

export function pushRouteHistory(entry) {
  if (typeof window === 'undefined' || !entry?.to || entry.to === '/') {
    return readRouteHistory();
  }

  const nextHistory = [
    entry,
    ...readRouteHistory().filter((item) => item.to !== entry.to),
  ].slice(0, MAX_ITEMS);

  window.localStorage.setItem(STORAGE_KEY, JSON.stringify(nextHistory));
  window.dispatchEvent(new CustomEvent('damnwear:route-history', { detail: nextHistory }));
  return nextHistory;
}
