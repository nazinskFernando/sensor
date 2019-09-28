<?php

interface HidrometroInterface {
    public function cadastroHidrometro(Hidrometro $hidrometro);
    public function buscarHidrometroTag(Hidrometro $hidrometro);
    public function buscarHidrometroId(Hidrometro $hidrometro);
}
