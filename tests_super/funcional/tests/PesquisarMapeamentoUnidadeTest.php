<?php

class PesquisarMapeamentoUnidadeTest extends FixtureCenarioBaseTestCase
{
    public static $remetente;

    /**
     * Teste da listagem de mapeamento de unidades
     *
     * @group envio
     * @large
     * 
     * @Depends CenarioBaseTestCase::setUpBeforeClass
     *
     * @return void
     */
    public function test_listagem_mapeamento_unidade_sigla_nao_encontrada()
    {
        self::$remetente = $this->definirContextoTeste(CONTEXTO_ORGAO_A);
        $this->acessarSistema(self::$remetente['URL'], self::$remetente['SIGLA_UNIDADE'], self::$remetente['LOGIN'], self::$remetente['SENHA']);
        $this->navegarMapeamentoUnidade();
        $this->byId('txtSiglaUnidade')->value('00000');
        $this->byId('btnPesquisar')->click();

        $mensagem = mb_convert_encoding('Nenhum mapeamento foi encontrado', 'UTF-8', 'ISO-8859-1');

        $this->waitUntil(function ($testCase) use ($mensagem) {
            $this->assertStringContainsString($mensagem, $testCase->byCssSelector('body')->text());
            return true;
        }, PEN_WAIT_TIMEOUT);
    }

    public function test_listagem_mapeamento_unidade_sigla_encontrada()
    {
        self::$remetente = $this->definirContextoTeste(CONTEXTO_ORGAO_A);
        $this->acessarSistema(self::$remetente['URL'], self::$remetente['SIGLA_UNIDADE'], self::$remetente['LOGIN'], self::$remetente['SENHA']);
        $this->navegarMapeamentoUnidade();
        $this->byId('txtSiglaUnidade')->value('TESTE');
        $this->byId('btnPesquisar')->click();

        $mensagem = mb_convert_encoding('TESTE', 'UTF-8', 'ISO-8859-1');
        
        $this->waitUntil(function ($testCase) use ($mensagem) {
            $this->assertStringContainsString($mensagem, $testCase->byCssSelector('body')->text());
            return true;
        }, PEN_WAIT_TIMEOUT);
    }

    public function test_listagem_mapeamento_unidade_descricao_nao_encontrada()
    {
        self::$remetente = $this->definirContextoTeste(CONTEXTO_ORGAO_A);
        $this->acessarSistema(self::$remetente['URL'], self::$remetente['SIGLA_UNIDADE'], self::$remetente['LOGIN'], self::$remetente['SENHA']);
        $this->navegarMapeamentoUnidade();
        $this->byId('txtDescricaoUnidade')->value('00000');
        $this->byId('btnPesquisar')->click();

        $mensagem = mb_convert_encoding('Nenhum mapeamento foi encontrado', 'UTF-8', 'ISO-8859-1');
        
        $this->waitUntil(function ($testCase) use ($mensagem) {
            $this->assertStringContainsString($mensagem, $testCase->byCssSelector('body')->text());
            return true;
        }, PEN_WAIT_TIMEOUT);
    }

    public function test_listagem_mapeamento_unidade_descricao_encontrada()
    {
        self::$remetente = $this->definirContextoTeste(CONTEXTO_ORGAO_A);
        $this->acessarSistema(self::$remetente['URL'], self::$remetente['SIGLA_UNIDADE'], self::$remetente['LOGIN'], self::$remetente['SENHA']);
        $this->navegarMapeamentoUnidade();
        $this->byId('txtDescricaoUnidade')->value('Unidade de Teste');
        $this->byId('btnPesquisar')->click();

        $mensagem = mb_convert_encoding('Unidade de Teste', 'UTF-8', 'ISO-8859-1');
        
        $this->waitUntil(function ($testCase) use ($mensagem) {
            $this->assertStringContainsString($mensagem, $testCase->byCssSelector('body')->text());
            return true;
        }, PEN_WAIT_TIMEOUT);
    }

}