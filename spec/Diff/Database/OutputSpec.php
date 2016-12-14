<?php

namespace spec\App\Diff\Database;

use App\Contracts\Support\Output as OutputContract;
use App\Diff\Database\Output;
use App\Models\Eloquent\Log;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OutputSpec extends ObjectBehavior
{
    function let(Log $log)
    {
        $this->beConstructedWith($log);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Output::class);
    }

    function it_implements_output_contract()
    {
        $this->shouldBeAnInstanceOf(OutputContract::class);
    }

    function it_logs_message_using_log_Model(Log $log)
    {
        $log->newInstance()->shouldBeCalled()->willReturn($log);
        $log->setAttribute(Argument::type('string'), Argument::any())->shouldBeCalled();

        $log->save()->shouldBeCalled()->willReturn($log);

        $this->write('A Message!');
    }
}
