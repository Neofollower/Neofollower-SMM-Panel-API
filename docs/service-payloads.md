# Service-Specific Order Payloads

NeoFollower services do not all use the same order fields. The service catalog and panel documentation should be checked before integrating a particular service.

The live documentation currently exposes the following request shapes.

## Standard quantity / drip-feed payload

```text
key
action=add
service
link
quantity
runs       optional
interval   optional
```

`runs` is the number of deliveries and `interval` is the interval in minutes when a service supports drip-feed ordering.

## Link-only payload

Some service types require the target `link` but do not expose a quantity field in the documented payload:

```text
key
action=add
service
link
```

## Comments payload

```text
key
action=add
service
link
comments
```

`comments` is a newline-separated list. Use `\n` or `\r\n` between entries.

## Usernames and hashtags payload

```text
key
action=add
service
link
quantity
usernames
hashtags
```

`usernames` and `hashtags` are newline-separated lists where supported.

## Usernames-list payload

```text
key
action=add
service
link
usernames
```

## Hashtag-source payload

```text
key
action=add
service
link
quantity
hashtag
```

The `hashtag` field identifies the hashtag used by the supported service.

## Username / follower-source payload

```text
key
action=add
service
link
quantity
username
```

For the corresponding service type, the API documentation describes `username` as the URL used to source followers.

## Comment-owner payload

```text
key
action=add
service
link
quantity
username
```

For the corresponding comment-related service type, `username` identifies the comment owner. This has the same parameter names as another documented payload, so the selected service determines the meaning.

## Subscription-style payload

```text
key
action=add
service
username
min
max
delay
expiry     optional
```

Documented delay values:

```text
0, 5, 10, 15, 30, 60, 90
```

The documented expiry date format is:

```text
d/m/Y
```

## Important integration rule

Do not determine a payload only from the parameter names above. First identify the service being ordered and use the fields that the current service type expects.

The canonical live documentation is:

https://panel.neofollower.com/api/docs
