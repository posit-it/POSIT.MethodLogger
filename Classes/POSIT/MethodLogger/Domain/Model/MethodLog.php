<?php
namespace POSIT\MethodLogger\Domain\Model;

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
use Doctrine\ORM\Mapping as ORM;

/**
 * Il messaggio che viene inserito nel database ad ogni chiamata dei metodi
 * annotati.
 *
 * @Flow\Entity
 */
class MethodLog {

	/**
	 * La data della chiamata del metodo.
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * L'indirizzo che ha causato l'invocazione del metodo loggato.
	 * @var string
	 * @ORM\Column(length=15, nullable=true)
	 */
	protected $ip;

	/**
	 * Il messaggio che descrive l'operazione
	 * @var string
	 * @ORM\Column(length=1000)
	 */
	protected $message;

	/**
	 * Crea un oggetto di tipo MethodLog. Il costruttore associa inoltre
	 * associa inoltre la data alla chiamata del metodo.
	 *
	 */
	public function __construct() {
		$this->date = new \DateTime();
	}

	/**
	 * Ritorna la data della chiamata del metodo.
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Ritorna l'ip associato alla chiamata del metodo.
	 * @return string
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Imposta l'ip associato alla chiamata del metodo.
	 * @param string
	 * @return void
	 */
	public function setIp($ip) {
		$this->ip = str_pad($ip, 15);
	}

	/**
	 * Ritorna il messaggio che descrive la chiamata del metodo.
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Imposta il messaggio che descrive la chiamata del metodo.
	 * @param string $message Il messaggio che descrive la chiamata del metodo.
	 * @return void
	 */
	public function setMessage($message) {
		return $this->message = $message;
	}

}

?>
