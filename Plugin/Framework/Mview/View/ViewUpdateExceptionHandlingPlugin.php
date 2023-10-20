<?php
/**
 * Copyright © COMMERCY TECNOLOGIA LTDA, Inc. All rights reserved.
 */

declare(strict_types = 1);

namespace Commercy\ImprovedIndexer\Plugin\Framework\Mview\View;

use Magento\Framework\Mview\View;
use Psr\Log\LoggerInterface;

class ViewUpdateExceptionHandlingPlugin
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function aroundUpdate(View $subject, callable $proceed): void
    {
        try {
            $proceed();
        } catch (\Exception $e) {
            $this->logger->error(
                sprintf(
                    'Error while updating view \'%s\': %s',
                    $subject->getId(),
                    $e->getMessage()
                )
            );
        }
    }
}