# NeoFollower SMM Panel Reseller API

**Official NeoFollower reseller API documentation, integration reference, and code examples for SMM panels, agencies, developers, and social media service resellers.**

Use the NeoFollower API to retrieve available services, place reseller orders, check single or multiple order statuses, and query your account balance programmatically.

- **API endpoint:** `https://panel.neofollower.com/api/v1`
- **HTTP method:** `POST`
- **Response format:** `JSON`
- **Authentication:** API key in the request body
- **Official website:** https://neofollower.com
- **Live API documentation:** https://panel.neofollower.com/api/docs

> This repository is maintained as the public developer reference for the NeoFollower reseller API. Never commit your real API key to source control.

## What is the NeoFollower Reseller API?

The NeoFollower Reseller API is an HTTP API for automating common SMM panel reseller workflows. A reseller can connect a website, panel, script, application, or internal automation to NeoFollower and interact with the service catalog and order system without placing every order manually.

Typical integrations include:

- SMM reseller panels
- Custom social media marketing dashboards
- Agency order-management systems
- WordPress or WooCommerce integrations
- Internal automation tools
- Server-side scripts and scheduled jobs

## Quick start

Every request is sent to the same endpoint:

```text
https://panel.neofollower.com/api/v1
```

Send parameters as a `POST` request. Your API key is passed using the `key` parameter and the operation is selected using `action`.

### 1. Get the service list

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=services"
```

### 2. Place an order

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=add" \
  -d "service=SERVICE_ID" \
  -d "link=https://example.com/post" \
  -d "quantity=100"
```

Example response:

```json
{
  "status": "success",
  "order": 32
}
```

### 3. Check an order

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=status" \
  -d "order=32"
```

### 4. Check your balance

```bash
curl -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=YOUR_API_KEY" \
  -d "action=balance"
```

## API actions

| Action | Purpose | Main parameters |
|---|---|---|
| `services` | Retrieve the current service catalog | `key`, `action` |
| `add` | Place a new reseller order | `key`, `action`, `service`, service-specific fields |
| `status` | Check one order | `key`, `action`, `order` |
| `status` | Check multiple orders | `key`, `action`, `orders` |
| `balance` | Retrieve account balance and currency | `key`, `action` |

See the complete [API reference](docs/api-reference.md).

## Code examples

Ready-to-edit examples are included for several common environments:

- [cURL / shell](examples/curl/README.md)
- [PHP](examples/php/neofollower.php)
- [Python](examples/python/neofollower.py)
- [JavaScript / Node.js](examples/javascript/neofollower.mjs)
- [Go](examples/go/main.go)
- [Postman collection](postman/NeoFollower-Reseller-API.postman_collection.json)

All examples read the API key from an environment variable where practical.

## Machine-readable API definition

The repository includes an [OpenAPI 3.1 definition](openapi.yaml) for the core API actions. It can be imported into compatible API clients, documentation systems, developer tools, and code assistants.

## Authentication

NeoFollower uses an API key supplied as the `key` request parameter.

```text
key=YOUR_API_KEY
```

Keep API credentials server-side. Do not expose an API key in browser JavaScript, public repositories, screenshots, support posts, or frontend source code.

## Request format

Requests should be sent with `POST`. Form-encoded requests are the simplest interoperable option:

```http
POST /api/v1 HTTP/1.1
Host: panel.neofollower.com
Content-Type: application/x-www-form-urlencoded

key=YOUR_API_KEY&action=balance
```

## Service-specific order payloads

Different NeoFollower services can require different order fields. Common fields exposed by the API documentation include:

`service`, `link`, `quantity`, `runs`, `interval`, `comments`, `usernames`, `hashtags`, `hashtag`, `username`, `min`, `max`, `delay`, and `expiry`.

Do not assume every field applies to every service. Retrieve the current service catalog and follow the requirements of the service you are ordering.

See [service-specific payloads](docs/service-payloads.md).

## Error handling

Production integrations should:

1. Validate required input before sending an order.
2. Treat non-2xx responses as transport failures.
3. Validate that the response is JSON before parsing it.
4. Check response fields before assuming an order was created.
5. Store the returned order ID.
6. Poll order status responsibly instead of making rapid repeated requests.
7. Log errors without logging API keys.

See [troubleshooting and integration safety](docs/troubleshooting.md).

## FAQ

### What is the NeoFollower API endpoint?

The official reseller API endpoint is:

```text
https://panel.neofollower.com/api/v1
```

### What format does the API return?

The API returns JSON responses.

### How do I authenticate?

Include your NeoFollower API key in the `key` parameter of each API request.

### Can I retrieve NeoFollower services through the API?

Yes. Send `action=services`.

### Can I place SMM reseller orders automatically?

Yes. Send `action=add` together with the service ID and the parameters required by that service.

### Can I check multiple order statuses?

Yes. Use `action=status` and send comma-separated order IDs in the `orders` parameter.

### Can I check my reseller balance through the API?

Yes. Send `action=balance`.

More answers are available in the [NeoFollower API FAQ](docs/faq.md).

## Repository structure

```text
.
├── README.md
├── openapi.yaml
├── CHANGELOG.md
├── CITATION.cff
├── LICENSE
├── SECURITY.md
├── CONTRIBUTING.md
├── docs/
│   ├── api-reference.md
│   ├── service-payloads.md
│   ├── integration-guide.md
│   ├── troubleshooting.md
│   └── faq.md
├── examples/
│   ├── curl/
│   ├── php/
│   ├── python/
│   ├── javascript/
│   └── go/
└── postman/
    └── NeoFollower-Reseller-API.postman_collection.json
```

## Official NeoFollower links

- Website: https://neofollower.com
- Reseller panel: https://panel.neofollower.com
- Live API docs: https://panel.neofollower.com/api/docs

## Support

For account, service, order, or API-key questions, use the official NeoFollower support channels available through the website or reseller panel.

For errors in this repository's documentation or examples, open a GitHub issue.

## License

The documentation and example code in this repository are released under the [MIT License](LICENSE), unless a file states otherwise.

---

**NeoFollower** — official reseller API documentation and integration examples for developers building with the NeoFollower SMM panel.
