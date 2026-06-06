<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Webhooks\WebhookCreateParams\Event;
use Bila\Webhooks\WebhookDeactivateResponse;
use Bila\Webhooks\WebhookGetDeliveriesResponse;
use Bila\Webhooks\WebhookListEventsResponse;
use Bila\Webhooks\WebhookListResponse;
use Bila\Webhooks\WebhookNewResponse;
use Bila\Webhooks\WebhookRotateSecretResponse;
use Bila\Webhooks\WebhookUpdateResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
     *
     * @param list<Event|value-of<Event>> $events Event types to subscribe to
     * @param string $url Webhook endpoint URL
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $events,
        string $url,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookNewResponse;

    /**
     * @api
     *
     * @param string $id Webhook config UUID
     * @param list<\Bila\Webhooks\WebhookUpdateParams\Event|value-of<\Bila\Webhooks\WebhookUpdateParams\Event>> $events Event types to subscribe to
     * @param bool $isActive Whether the webhook is active
     * @param string $url Webhook endpoint URL
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?array $events = null,
        ?bool $isActive = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookUpdateResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): WebhookListResponse;

    /**
     * @api
     *
     * @param string $id Webhook config UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deactivate(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): WebhookDeactivateResponse;

    /**
     * @api
     *
     * @param string $id Webhook config UUID
     * @param string $endDate ISO 8601 end of createdAt range (inclusive)
     * @param string $eventType Filter by event type
     * @param float $page Page number
     * @param float $perPage Items per page
     * @param string $startDate ISO 8601 start of createdAt range (inclusive)
     * @param string $status Filter by status (QUEUED, DELIVERED, FAILED, RETRYING)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getDeliveries(
        string $id,
        ?string $endDate = null,
        ?string $eventType = null,
        float $page = 1,
        float $perPage = 20,
        ?string $startDate = null,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookGetDeliveriesResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listEvents(
        RequestOptions|array|null $requestOptions = null
    ): WebhookListEventsResponse;

    /**
     * @api
     *
     * @param string $id Webhook config UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateSecret(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): WebhookRotateSecretResponse;
}
