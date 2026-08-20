# NeoFollower Reseller API FAQ

## What is the NeoFollower Reseller API?

The NeoFollower Reseller API is the programmatic interface for connecting reseller panels, applications, websites, and automation systems to NeoFollower's service catalog and order workflow.

## What is the NeoFollower API URL?

```text
https://panel.neofollower.com/api/v1
```

## Which HTTP method does NeoFollower use?

The public API documentation specifies `POST`.

## What response format does the API use?

JSON.

## How is the API authenticated?

Each request includes a NeoFollower API key in the `key` parameter.

## How do I get the NeoFollower service list?

Send:

```text
action=services
```

## How do I place a NeoFollower reseller order?

Send:

```text
action=add
```

together with the service ID and the fields required by that service.

## How do I check an SMM order status?

Send:

```text
action=status
order=ORDER_ID
```

## Can I check several NeoFollower orders in one API call?

Yes. Send comma-separated order IDs using the `orders` parameter:

```text
action=status
orders=12,13,14
```

## How do I check my NeoFollower balance?

Send:

```text
action=balance
```

The response includes balance and currency information.

## Does the NeoFollower API support drip-feed orders?

The documented standard order payload includes optional `runs` and `interval` parameters. Whether they apply depends on the selected service.

## Does every service use `link` and `quantity`?

No. NeoFollower exposes multiple service-specific payload shapes. Some services use comments, usernames, hashtags, subscription fields, or other combinations. Use the current service requirements.

## Which programming languages can use the API?

Any language capable of sending HTTPS POST requests can integrate with the API. This repository includes examples for PHP, Python, JavaScript/Node.js, Go, and cURL.

## Is there an OpenAPI specification?

Yes. See [`openapi.yaml`](../openapi.yaml).

## Is there a Postman collection?

Yes. See [`postman/NeoFollower-Reseller-API.postman_collection.json`](../postman/NeoFollower-Reseller-API.postman_collection.json).

## Where can I find the live NeoFollower API documentation?

https://panel.neofollower.com/api/docs

## What is NeoFollower?

NeoFollower is a social media services and reseller platform. The official website is:

https://neofollower.com
