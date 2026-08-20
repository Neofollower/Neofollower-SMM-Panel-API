# NeoFollower Reseller API Reference

This page documents the core actions exposed by the NeoFollower SMM Panel Reseller API.

## Base endpoint

```text
POST https://panel.neofollower.com/api/v1
```

Responses are returned as JSON.

## Authentication

Every request requires:

| Parameter | Description |
|---|---|
| `key` | Your NeoFollower API key |

The requested operation is selected with the `action` parameter.

---

## List services

Retrieve the current service catalog.

### Request

| Parameter | Value |
|---|---|
| `key` | Your API key |
| `action` | `services` |

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=services"
```

### Example response shape

```json
[
  {
    "service": "123",
    "name": "Example Service",
    "category": "Example Category",
    "rate": "1.02",
    "min": "100",
    "max": "10000",
    "type": "default",
    "desc": "",
    "dripfeed": 1
  }
]
```

Service fields and available services can change. Treat the live API response as authoritative.

---

## Place an order

### Standard request

| Parameter | Required | Description |
|---|---:|---|
| `key` | yes | Your API key |
| `action` | yes | `add` |
| `service` | yes | Service ID |
| `link` | service-dependent | Target URL |
| `quantity` | service-dependent | Requested quantity |
| `runs` | no | Number of drip-feed runs |
| `interval` | no | Interval between runs in minutes |

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=add" \
  -d "service=123" \
  -d "link=https://example.com/post" \
  -d "quantity=100"
```

### Example response

```json
{
  "status": "success",
  "order": 32
}
```

The exact required fields depend on the selected service. See [service-specific payloads](service-payloads.md).

---

## Single order status

### Request

| Parameter | Description |
|---|---|
| `key` | Your API key |
| `action` | `status` |
| `order` | Order ID |

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=status" \
  -d "order=32"
```

### Example response

```json
{
  "order": "32",
  "status": "pending",
  "charge": "0.0360",
  "start_count": "0",
  "remains": "0"
}
```

---

## Multiple order statuses

### Request

| Parameter | Description |
|---|---|
| `key` | Your API key |
| `action` | `status` |
| `orders` | Comma-separated order IDs |

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=status" \
  -d "orders=12,2,13"
```

### Example response shape

```json
{
  "12": {
    "order": "12",
    "status": "processing",
    "charge": "1.2600",
    "start_count": "0",
    "remains": "0"
  },
  "2": "Incorrect order ID",
  "13": {
    "order": "13",
    "status": "pending",
    "charge": "0.6300",
    "start_count": "0",
    "remains": "0"
  }
}
```

A batch response can contain a status object for valid IDs and an error message for an invalid ID. Handle each order independently.

---

## Balance

### Request

| Parameter | Description |
|---|---|
| `key` | Your API key |
| `action` | `balance` |

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=balance"
```

### Example response

```json
{
  "status": "success",
  "balance": "0.03",
  "currency": "USD"
}
```

---

## Data types

Some numeric-looking API fields may be returned as strings. Do not assume values such as `service`, `rate`, `min`, `max`, `charge`, `start_count`, `remains`, or `balance` are native JSON numbers.

## Live documentation

The panel documentation remains the live operational reference:

https://panel.neofollower.com/api/docs
