<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\WebhooksContract;
use Bila\Webhooks\WebhookCreateParams\Event;
use Bila\Webhooks\WebhookDeactivateResponse;
use Bila\Webhooks\WebhookGetDeliveriesResponse;
use Bila\Webhooks\WebhookListEventsResponse;
use Bila\Webhooks\WebhookListResponse;
use Bila\Webhooks\WebhookNewResponse;
use Bila\Webhooks\WebhookRotateSecretResponse;
use Bila\Webhooks\WebhookUpdateResponse;

/**
 * Webhook configuration and delivery history.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
    }

    /**
     * @api
     *
     * Create a webhook config
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
        RequestOptions|array|null $requestOptions = null
    ): WebhookNewResponse {
        $params = Util::removeNulls(['events' => $events, 'url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a webhook config
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
    ): WebhookUpdateResponse {
        $params = Util::removeNulls(
            ['events' => $events, 'isActive' => $isActive, 'url' => $url]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List webhook configs
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): WebhookListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deactivate a webhook
     *
     * @param string $id Webhook config UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deactivate(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): WebhookDeactivateResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deactivate($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get delivery history
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
    ): WebhookGetDeliveriesResponse {
        $params = Util::removeNulls(
            [
                'endDate' => $endDate,
                'eventType' => $eventType,
                'page' => $page,
                'perPage' => $perPage,
                'startDate' => $startDate,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getDeliveries($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List webhook event types
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listEvents(
        RequestOptions|array|null $requestOptions = null
    ): WebhookListEventsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listEvents(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Rotate webhook signing secret
     *
     * @param string $id Webhook config UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function rotateSecret(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): WebhookRotateSecretResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->rotateSecret($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
