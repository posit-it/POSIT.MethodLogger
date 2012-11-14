<?php
namespace POSIT\MethodLogger\Command;

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
 * Dichiara un'annotazione utilizzata per indicare che l'esecuzione del metodo
 * dev'essere registrata nel database.
 *
 */
class MethodLogCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \POSIT\MethodLogger\Domain\Repository\MethodLogRepository
	 */
	protected $methodLogRepository;

	/**
	 * Visualizza la lista delle operazioni di log.
	 * @return void
	 */
	public function listMethodLogCommand() {
		$methodLogs = $this->methodLogRepository->findAll();
		$this->outputLine("\nChiamate a metodi salvati nel database:");
		$this->outputLine("---------------------------------------------------");
		foreach ($methodLogs as $methodLog) {
			$this->outputLine("Data: " . $methodLog->getDate()->format("d/m/Y H:i:s"));
			$this->outputLine("Messaggio: " . $methodLog->getMessage());
			$this->outputLine("---------------------------------------------------");
		}
		$this->outputLine("");
	}

}

?>
