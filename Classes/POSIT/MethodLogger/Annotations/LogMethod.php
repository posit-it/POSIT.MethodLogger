<?php
namespace POSIT\MethodLogger\Annotations;

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

/**
 * Dichiara un'annotazione utilizzata per indicare che l'esecuzione del metodo
 * dev'essere registrata nel database.
 *
 * @Annotation
 * @Target("METHOD")
 */
final class LogMethod {

	/**
	 * Il messaggio che dev'essere inserito nel database
	 * @var string
	 */
	public $message;

	/**
	 * @param array $values
	 * @throws \InvalidArgumentException
	 */
	public function __construct(array $values) {
		if (!isset($values['message'])) {
			throw new \InvalidArgumentException('Il messaggio di errore dev\'essere impostato.', 1352885349);
		}
		$this->message = $values['message'];
	}

}

?>
