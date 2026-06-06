<?php

declare(strict_types=1);

namespace Bila\Transfers;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type TransferResponseDtoShape from \Bila\Transfers\TransferResponseDto
 *
 * @phpstan-type TransferGetStatusByReferenceResponseShape = array{
 *   message: string,
 *   status: bool,
 *   data?: null|TransferResponseDto|TransferResponseDtoShape,
 * }
 */
final class TransferGetStatusByReferenceResponse implements BaseModel
{
    /** @use SdkModel<TransferGetStatusByReferenceResponseShape> */
    use SdkModel;

    /**
     * Response message.
     */
    #[Required]
    public string $message;

    /**
     * Request success status.
     */
    #[Required]
    public bool $status;

    #[Optional]
    public ?TransferResponseDto $data;

    /**
     * `new TransferGetStatusByReferenceResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferGetStatusByReferenceResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferGetStatusByReferenceResponse)->withMessage(...)->withStatus(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param TransferResponseDto|TransferResponseDtoShape|null $data
     */
    public static function with(
        string $message,
        bool $status,
        TransferResponseDto|array|null $data = null
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['status'] = $status;

        null !== $data && $self['data'] = $data;

        return $self;
    }

    /**
     * Response message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Request success status.
     */
    public function withStatus(bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param TransferResponseDto|TransferResponseDtoShape $data
     */
    public function withData(TransferResponseDto|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
