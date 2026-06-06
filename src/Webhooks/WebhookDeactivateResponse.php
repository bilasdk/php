<?php

declare(strict_types=1);

namespace Bila\Webhooks;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookDeactivateResponseShape = array{
 *   message: string, status: bool
 * }
 */
final class WebhookDeactivateResponse implements BaseModel
{
    /** @use SdkModel<WebhookDeactivateResponseShape> */
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

    /**
     * `new WebhookDeactivateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookDeactivateResponse::with(message: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookDeactivateResponse)->withMessage(...)->withStatus(...)
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
     */
    public static function with(string $message, bool $status): self
    {
        $self = new self;

        $self['message'] = $message;
        $self['status'] = $status;

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
}
