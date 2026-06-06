<?php

declare(strict_types=1);

namespace Bila\Transactions;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type TransactionResponseDtoShape from \Bila\Transactions\TransactionResponseDto
 *
 * @phpstan-type TransactionGetResponseShape = array{
 *   message: string,
 *   status: bool,
 *   data?: null|TransactionResponseDto|TransactionResponseDtoShape,
 * }
 */
final class TransactionGetResponse implements BaseModel
{
    /** @use SdkModel<TransactionGetResponseShape> */
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
    public ?TransactionResponseDto $data;

    /**
     * `new TransactionGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransactionGetResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransactionGetResponse)->withMessage(...)->withStatus(...)
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
     * @param TransactionResponseDto|TransactionResponseDtoShape|null $data
     */
    public static function with(
        string $message,
        bool $status,
        TransactionResponseDto|array|null $data = null
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
     * @param TransactionResponseDto|TransactionResponseDtoShape $data
     */
    public function withData(TransactionResponseDto|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
