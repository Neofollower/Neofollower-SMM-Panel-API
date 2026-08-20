/**
 * Minimal NeoFollower Reseller API example.
 *
 * Requires Node.js 18+ for built-in fetch.
 *
 * Run:
 *   NEOFOLLOWER_API_KEY="YOUR_API_KEY" node neofollower.mjs
 */

const API_URL = "https://panel.neofollower.com/api/v1";
const API_KEY = process.env.NEOFOLLOWER_API_KEY;

if (!API_KEY) {
  throw new Error("Set NEOFOLLOWER_API_KEY first.");
}

async function requestApi(payload) {
  const body = new URLSearchParams({
    ...payload,
    key: API_KEY,
  });

  const response = await fetch(API_URL, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      Accept: "application/json",
    },
    body,
  });

  if (!response.ok) {
    throw new Error(`NeoFollower API HTTP error: ${response.status}`);
  }

  return response.json();
}

export function services() {
  return requestApi({ action: "services" });
}

export function addOrder({ service, link, quantity, ...extra }) {
  return requestApi({
    action: "add",
    service: String(service),
    link,
    quantity: String(quantity),
    ...extra,
  });
}

export function status(orderId) {
  return requestApi({
    action: "status",
    order: String(orderId),
  });
}

export function multipleStatus(orderIds) {
  return requestApi({
    action: "status",
    orders: orderIds.join(","),
  });
}

export function balance() {
  return requestApi({ action: "balance" });
}

console.log(await balance());
