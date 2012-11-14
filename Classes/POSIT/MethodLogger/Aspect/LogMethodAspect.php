<?php
namespace POSIT\MethodLogger\Aspect;

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
 * Intercetta l'esecuzione del metodo che dev'essere loggato e inserisce la
 * riga nel database.
 *
 * @Flow\Aspect
 */
class LogMethodAspect {

	/**
	 * L'array che contiene le impostazioni specificate per il package.
	 * @var array
	 */
	protected $settings;

	/**
	 * Oggetto che permette di gestire direttamente la persistenza degli
	 * oggetti.
	 *
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * Il servizio che permette di leggere le caratteristiche del codice.
	 *
	 * @Flow\Inject
         * @var \TYPO3\Flow\Reflection\ReflectionService
         */
         protected $reflectionService;

	/**
	 * Il repository delle operazioni fatte dagli utenti.
	 *
	 * @Flow\Inject
	 * @var \POSIT\MethodLogger\Domain\Repository\MethodLogRepository
	 */
	protected $methodLogRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * @param array $settings
	 * @return void
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
	}

	/**
	 * Salva un oggetto che descrive una chiamata al metodo annotato nel database.
	 * 
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint Il punto di join corrente
	 * @return void
	 * @Flow\Around("methodAnnotatedWith(POSIT\MethodLogger\Annotations\LogMethod)")
	 */
	public function runMethodLogging(\TYPO3\Flow\Aop\JoinPointInterface $joinPoint) {
		$logMethod = $this->getLogMethodAnnotation($joinPoint);
		$this->logMessage($joinPoint, $logMethod);
error_log('asd');
		return $joinPoint->getAdviceChain()->proceed($joinPoint);
	}

	/**
	 * Ritorna vero se il logger e' abilitato nella configurazione, falso altrimenti.
	 *
	 * @return boolean Vero se il logger e' abilitato, falso altrimenti.
	 */
	private function isEnabled() {
		return array_key_exists('enable', $this->settings) && $this->settings['enable'];
	}

	/**
	 * Ritorna l'annotazione associata al metodo descritto nel join point.
	 *
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint L'oggetto che descrive il punto in cui l'esecuzione del codice e' stata interrotta.
	 * @return \POSIT\MethodLogger\Annotations\LogMethod L'annotazione che descrive come loggare la chiamata al metodo.
	 */
	private function getLogMethodAnnotation(\TYPO3\Flow\Aop\JoinPointInterface $joinPoint)
	{
		$annotations = $this->reflectionService->getMethodAnnotations(
					$joinPoint->getClassName(),
					$joinPoint->getMethodName(),
					'POSIT\MethodLogger\Annotations\LogMethod'
			       );
		return $annotations[0];
	}

	/**
	 * Ritorna l'annotazione associata al metodo descritto nel join point.
	 *
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint L'oggetto che descrive il punto in cui l'esecuzione del codice e' stata interrotta.
	 * @param \POSIT\MethodLogger\Annotations\LogMethod $logMethod L'annotazione che descrive come loggare la chiamata al metodo.
	 * @return void
	 */
	private function logMessage(\TYPO3\Flow\Aop\JoinPointInterface $joinPoint,
				    \POSIT\MethodLogger\Annotations\LogMethod $logMethod) {
		if ($this->isEnabled()) {
			$methodLog = new \POSIT\MethodLogger\Domain\Model\MethodLog();

			$methodLog->setMessage($this->renderViewText($joinPoint, $logMethod->message));
			$methodLog->setIp(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');

			$this->methodLogRepository->add($methodLog);

			$this->persistenceManager->persistAll();
		}
	}

	/**
	 * Renderizza un testo sfruttando Fluid. Nel contesto di rendering vengono messi a disposizione i parametri con cui e' stato chiamato
	 * il metodo che verra' loggato.
	 *
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint L'oggetto che descrive il punto in cui l'esecuzione del codice e' stata interrotta.
	 * @param string $text Il testo che contiene la stringa da renderizzare
	 * @return string Il testo renderizzato
	 */
	private function renderViewText(\TYPO3\Flow\Aop\JoinPointInterface $joinPoint, $text) {
		$textView = new \TYPO3\Fluid\View\StandaloneView();
		$textView->initializeObject();
		$textView->setTemplateSource($text);
		foreach ($joinPoint->getMethodArguments() as $name => $value) {
			$textView->assign($name, $value);
		}
		return $textView->render();
	}

}

?>
