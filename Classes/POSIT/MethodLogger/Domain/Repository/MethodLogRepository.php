<?php
namespace POSIT\MethodLogger\Domain\Repository;

/*                                                                        *
 * This script belongs to the Flow package "POSIT.MethodLogger".         *
 *                                                                        *
 * Copyright (c) 2012 POSIT (www.posit.it)                                *
 *                                                                        *
 * Permission is hereby granted, free of charge, to any person obtaining  *
 * a copy of this software and associated documentation files (the        *
 * "Software"), to deal in the Software without restriction, including    *
 * without limitation the rights to use, copy, modify, merge, publish,    *
 * distribute, sublicense, and/or sell copies of the Software, and to     *
 * permit persons to whom the Software is furnished to do so, subject to  *
 * the following conditions:                                              *
 *                                                                        *
 * The above copyright notice and this permission notice shall be         *
 * included in all copies or substantial portions of the Software.        *
 *                                                                        *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,        *
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF     *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY   *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,   *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE      *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                 *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Il repository che permette di gestire la persistenza degli oggetti di tipo
 * MethodLog.
 *
 * @Flow\Scope("singleton")
 */
class MethodLogRepository extends \TYPO3\Flow\Persistence\Repository {

	protected $defaultOrderings = array(
					'date' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING
				      );

}
?>
