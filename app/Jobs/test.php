<?php
declare(strict_types=1);
class ListNode
{
    public int $val = 0;
    public ListNode|null $next;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

class Solution
{
    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers(ListNode $l1, ListNode $l2)
    {
        print_r($l1);
        return new ListNode();
    }
}

$solution1 = new Solution();
print_r($solution1->addTwoNumbers(new ListNode(2, new ListNode(4, new ListNode(3))), new ListNode(5, new ListNode(6, new ListNode(4)))));
