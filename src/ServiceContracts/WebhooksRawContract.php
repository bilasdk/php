<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Webhooks\WebhookCreateParams;
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
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Webhook config UUID
     * @param array<string,mixed>|WebhookUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Webhook config UUID
     * @param array<string,mixed>|WebhookGetDeliveriesParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListEventsResponse>
     *
     * @throws APIException
     */
    public function listEvents(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
