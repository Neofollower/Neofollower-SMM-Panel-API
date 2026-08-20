# Integration Guide

This guide covers a practical production flow for integrating a reseller panel, application, or backend service with the NeoFollower API.

## Recommended workflow

### 1. Keep the API key server-side

Load the API key from an environment variable or secret manager.

```text
NEOFOLLOWER_API_KEY=...
```

Never embed the key in frontend JavaScript or publish it in a repository.

### 2. Fetch services

Request `action=services` and build your local service catalog from the returned data.

Store the NeoFollower service ID because it is required when placing an order.

### 3. Validate customer input

Before calling the API, validate the fields required by the selected service:

- target link or username
- quantity limits
- comments or usernames when applicable
- drip-feed values when applicable

The service list exposes fields such as `min`, `max`, `type`, and `dripfeed` that can help your integration decide what to display.

### 4. Place the order

Send `action=add`, the NeoFollower service ID, and the fields required by the service.

Persist the returned NeoFollower order ID together with your local order record.

### 5. Poll status responsibly

Use `action=status` with either `order` or `orders`.

For a reseller system handling many orders, batch status checks where possible instead of performing one request per order.

### 6. Update your local order

Typical response fields include:

- `status`
- `charge`
- `start_count`
- `remains`

Map API statuses to your own application's status model.

## Suggested local data model

At minimum, store:

```text
provider
provider_service_id
provider_order_id
target
quantity
status
charge
start_count
remains
created_at
last_checked_at
```

Do not store the API key with every order.

## Timeouts and retries

Use a finite HTTP timeout. Retry transport failures with exponential backoff, but do not blindly retry an order-creation request unless you know the original request did not create an order. Otherwise you risk duplicate orders.

Status and service-list requests are safer candidates for retrying.

## Logging

Useful fields to log:

```text
action
service_id
provider_order_id
http_status
duration
error_class
```

Do not log:

```text
API key
customer credentials
unnecessary sensitive request data
```

## Cache strategy

The service list does not need to be requested for every page load. A reseller application can cache the catalog and refresh it on a sensible schedule while ensuring service changes are handled.

No rate limit is documented in the public API reference, so integrations should avoid aggressive or unnecessary polling.
