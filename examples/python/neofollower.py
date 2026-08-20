"""Minimal NeoFollower Reseller API example.

Install:
    pip install requests

Run:
    export NEOFOLLOWER_API_KEY="YOUR_API_KEY"
    python neofollower.py
"""

import os
from typing import Any

import requests

API_URL = "https://panel.neofollower.com/api/v1"
API_KEY = os.environ["NEOFOLLOWER_API_KEY"]


def request_api(**payload: Any) -> Any:
    payload["key"] = API_KEY
    response = requests.post(API_URL, data=payload, timeout=30)
    response.raise_for_status()
    return response.json()


def services() -> Any:
    return request_api(action="services")


def add_order(service: int, link: str, quantity: int, **extra: Any) -> Any:
    return request_api(
        action="add",
        service=service,
        link=link,
        quantity=quantity,
        **extra,
    )


def status(order_id: int) -> Any:
    return request_api(action="status", order=order_id)


def multiple_status(order_ids: list[int]) -> Any:
    return request_api(
        action="status",
        orders=",".join(str(order_id) for order_id in order_ids),
    )


def balance() -> Any:
    return request_api(action="balance")


if __name__ == "__main__":
    print(balance())
