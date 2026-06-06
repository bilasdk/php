<?php

declare(strict_types=1);

namespace Bila\TransferRecipients;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;
use Bila\TransferRecipients\TransferRecipientListResponse\Data;

/**
 * @phpstan-import-type DataShape from \Bila\TransferRecipients\TransferRecipientListResponse\Data
 *
 * @phpstan-type TransferRecipientListResponseShape = array{
 *   message: string, status: bool, data?: null|Data|DataShape
 * }
 */
final class TransferRecipientListResponse implements BaseModel
{
    /** @use SdkModel<TransferRecipientListResponseShape> */
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
    public ?Data $data;

    /**
     * `new TransferRecipientListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferRecipientListResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferRecipientListResponse)->withMessage(...)->withStatus(...)
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
     * @param Data|DataShape|null $data
     */
    public static function with(
        string $message,
        bool $status,
        Data|array|null $data = null
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
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
