# Changelog

All notable changes to `saloon-slack` will be documented in this file.

## 0.0.4 - 2023-03-11

- Adds battle tested, Slack specific, OAuth setup
- Adds first specific 'ConversationsOpenRequest' for Slack's `conversations.open` endpoint
- Fixes `GenericGetRequest` requiring params to be on the `query` instead of the `body`

Other stuff I expect

## 0.0.1

Initial release with:

- Slack API Connector
- Slack Auth Connector (OAuth v2)
- Generic `GET` and `POST` Saloon requests
