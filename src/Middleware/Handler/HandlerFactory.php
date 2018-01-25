<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         1.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Authorization\Middleware\Handler;

use Cake\Core\App;
use RuntimeException;

class HandlerFactory
{
    /**
     * Creates unauthorized request handler.
     *
     * @param string $name Handler name.
     * @return \Authorization\Middleware\Handler\HandlerInterface
     * @throws RuntimeException When invalid handler encountered.
     */
    public static function create($name)
    {
        $class = App::className($name, 'Middleware/Handler', 'Handler');
        if (!$class) {
            $message = sprintf('Handler `%s` does not exist.', $name);
            throw new RuntimeException($message);
        }

        $instance = new $class();
        if (!$instance instanceof HandlerInterface) {
            $message = sprintf('Handler should implement `%s`, got `%s`.', HandlerInterface::class, get_class($instance));
            throw new RuntimeException($message);
        }

        return $instance;
    }
}
