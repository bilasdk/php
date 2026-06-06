<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\ServiceContracts\WebhooksRawContract;
use Bila\Webhooks\WebhookCreateParams;
use Bila\Webhooks\WebhookCreateParams\Event;
use Bila\Webhooks\WebhookDeactivateResponse;
use Bila\Webhooks\WebhookGetDeliveriesParams;
use Bila\Webhooks\WebhookGetDeliveriesResponse;
use Bila\Webhooks\WebhookListEventsResponse;
use Bila\Webhooks\WebhookListResponse;
use Bila\Webhooks\WebhookNewResponse;
use Bila\Webhooks\WebhookRotateSecretResponse;
use Bila\Webhooks\WebhookUpdateParams;
use Bila\Webhooks\WebhookUpdateResponse;

/**
 * Webhook configuration and delivery history.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class WebhooksRawService implements WebhooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a webhook config
     *
     * @param array{
     *   events: list<Event|value-of<Event>>, url: string
     * }|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/webhooks',
            body: (object) $parsed,
            options: $options,
            convert: WebhookNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Update a webhook config
     *
     * @param string $id Webhook config UUID
     * @param array{
     *   events?: list<WebhookUpdateParams\Event|value-of<WebhookUpdateParams\Event>>,
     *   isActive?: bool,
     *   url?: string,
     * }|WebhookUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|WebhookUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['api/v1/bila/webhooks/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: WebhookUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * List webhook configs
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/webhooks',
            options: $requestOptions,
            convert: WebhookListResponse::class,
        );
    }

    /**
     * @api
     *
     * Deactivate a webhook
     *
     * @param string $id Webhook config UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookDeactivateResponse>
     *
     * @throws APIException
     */
    public function deactivate(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/v1/bila/webhooks/%1$s', $id],
            options: $requestOptions,
            convert: WebhookDeactivateResponse::class,
        );
    }

    /**
     * @api
     *
     * Get delivery history
     *
     * @param string $id Webhook config UUID
     * @param array{
     *   endDate?: string,
     *   eventType?: string,
     *   page?: float,
     *   perPage?: float,
     *   startDate?: string,
     *   status?: string,
     * }|WebhookGetDeliveriesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookGetDeliveriesResponse>
     *
     * @throws APIException
     */
    public function getDeliveries(
        string $id,
        array|WebhookGetDeliveriesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookGetDeliveriesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/bila/webhooks/%1$s/deliveries', $id],
            query: $parsed,
            options: $options,
            convert: WebhookGetDeliveriesResponse::class,
        );
    }

    /**
     * @api
     *
     * List webhook event types
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListEventsResponse>
     *
     * @throws APIException
     */
    public function listEvents(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/webhooks/events',
            options: $requestOptions,
            convert: WebhookListEventsResponse::class,
        );
    }

    /**
     * @api
     *
     * Rotate webhook signing secret
     *
     * @param string $id Webhook config UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookRotateSecretResponse>
     *
     * @throws APIException
     */
    public function rotateSecret(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['api/v1/bila/webhooks/%1$s/rotate-secret', $id],
            options: $requestOptions,
            convert: WebhookRotateSecretResponse::class,
        );
    }
}
