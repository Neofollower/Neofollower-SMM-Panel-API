# Troubleshooting

## The API key does not work

Confirm that:

- the key belongs to the correct NeoFollower account;
- the complete key is being sent;
- there are no leading or trailing spaces;
- you are calling `https://panel.neofollower.com/api/v1`;
- the request includes the `key` parameter.

Do not post your API key in a public GitHub issue.

## The API returns an unexpected response

Log the HTTP status code and raw response body in a secure development environment before JSON parsing.

Verify that the request is being sent as `POST` and that form parameters are encoded correctly.

## An order is rejected or not created

Check:

- service ID;
- target format;
- minimum and maximum quantity;
- service-specific parameters;
- available balance;
- whether the service is currently available.

Always use the current service catalog rather than hard-coding assumptions indefinitely.

## Multiple-order status includes an error string

Batch status responses can contain normal status objects for valid IDs and an error message for an invalid order ID. Parse each key independently.

## Numeric fields arrive as strings

This is expected for several fields in API responses. Cast values explicitly only when your application needs numeric operations.

## Should I retry a failed order request?

Be cautious. Repeating `action=add` after an ambiguous network failure can potentially create a duplicate order if the original request reached the server.

Before retrying, determine whether an order ID was created whenever possible.

## Where is the canonical documentation?

https://panel.neofollower.com/api/docs
