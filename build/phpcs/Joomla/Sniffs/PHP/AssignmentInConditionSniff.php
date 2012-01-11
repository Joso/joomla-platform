<?php
/**
 * Assignment in condition Sniff
 * @package   JoomlaCodeSniffer
 * @category  PHP
 * @author    Nikolai Plath
 * @license   GNU GPL
 */

/**
 * Assignment in condition Sniff
 *
 * Ensures that the return value of a function is not used in both
 * an assignment to a variable and a conditional statement.
 *
 * @package   JoomlaCodeSniffer
 * @category  PHP
 */
class Joomla_Sniffs_PHP_AssignmentInConditionSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register()
	{
		return array(T_IF);
	}

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param PHP_CodeSniffer_File  $phpcsFile  The file being scanned.
	 * @param int                   $stackPtr   The position of the current token
	 *                                          in the stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		$endStatement = $phpcsFile->findNext(T_OPEN_CURLY_BRACKET, ($stackPtr + 1));

		for ($i = ($stackPtr + 1); $i < $endStatement; $i++)
		{
			if (T_EQUAL == $tokens[$i]['code'])
			{
				$phpcsFile->addError(
					'Assignments in conditions are not allowed'
					, $stackPtr
					, 'AssignmentInCondition');

				return;
			}
		}
	}
}
