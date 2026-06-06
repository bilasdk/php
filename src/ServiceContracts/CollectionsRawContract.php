<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Collections\CollectionGetResponse;
use Bila\Collections\CollectionGetStatusByReferenceResponse;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionResponse;
use Bila\Collections\CollectionListParams;
use Bila\Collections\CollectionListResponse;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface CollectionsRawContract
{
    /**
     * @api
     *
     * @param string $id Collection UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CollectionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CollectionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionGetStatusByReferenceResponse>
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CollectionInitiateMobileMoneyCollectionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CollectionInitiateMobileMoneyCollectionResponse>
     *
     * @throws APIException
     */
    public function initiateMobileMoneyCollection(
        array|CollectionInitiateMobileMoneyCollectionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
