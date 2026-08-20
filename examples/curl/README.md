# cURL Examples

Set your key:

```bash
export NEOFOLLOWER_API_KEY="YOUR_API_KEY"
```

## List services

```bash
curl -sS -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=${NEOFOLLOWER_API_KEY}" \
  -d "action=services"
```

## Place an order

```bash
curl -sS -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=${NEOFOLLOWER_API_KEY}" \
  -d "action=add" \
  -d "service=123" \
  -d "link=https://example.com/post" \
  -d "quantity=100"
```

## Order status

```bash
curl -sS -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=${NEOFOLLOWER_API_KEY}" \
  -d "action=status" \
  -d "order=32"
```

## Multiple statuses

```bash
curl -sS -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=${NEOFOLLOWER_API_KEY}" \
  -d "action=status" \
  -d "orders=12,13,14"
```

## Balance

```bash
curl -sS -X POST "https://panel.neofollower.com/api/v1" \
  -d "key=${NEOFOLLOWER_API_KEY}" \
  -d "action=balance"
```
