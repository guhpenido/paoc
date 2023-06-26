package br.cefetmg.mavenproject1;

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

class Texto {

    private String texto;

    public Texto() {
        this.texto = "";
    }

    public void escrever(String s) {
        this.texto += s;
    }

    public String getTexto() {
        return this.texto;
    }
}

class Memento {

    private final String estado;

    public Memento(Texto t) {
        this.estado = t.getTexto();
    }

    public String getEstado() {
        return this.estado;
    }
}

class Caretaker {

    private List<Memento> estados;
    private int indice;

    public Caretaker() {
        this.estados = new ArrayList<>();
        this.indice = -1;
    }

    public void salvar(Texto t) {
        Memento m = new Memento(t);
        this.estados.add(m);
        this.indice++;
    }

    public void carregar(Texto t, int i) {
        if (i >= 0 && i < this.estados.size()) {
            Memento m = this.estados.get(i);
            t.escrever(m.getEstado());
            this.indice = i;
        }
    }

    public void visualizar() {
        for (int i = 0; i < this.estados.size(); i++) {
            System.out.println(i + ": " + this.estados.get(i).getEstado());
        }
    }
}

class Main {

    private Texto texto; // Objeto que representa o originador
    private Caretaker caretaker; // Objeto que representa o cuidador

    public Main() {
        this.texto = new Texto();
        this.caretaker = new Caretaker();
    }

    public void executar() {
        Scanner sc = new Scanner(System.in);
        boolean sair = false;
        while (!sair) {
            System.out.println("Bem vindo!");
            System.out.println("Escolha uma opção:");
            System.out.println("a. Escrever");
            System.out.println("b. Visualizar");
            System.out.println("c. Salvar");
            System.out.println("d. Carregar");
            System.out.println("e. Sair");
            String opcao = sc.nextLine();
            switch (opcao) {
                case "a":
                    System.out.println("Digite uma palavra/texto para ser adicionada ao texto final:");
                    String s = sc.nextLine();
                    this.texto.escrever(s);
                    break;
                case "b":
                    System.out.println("O texto total que foi digitado é:");
                    System.out.println(this.texto.getTexto());
                    break;
                case "c":
                    this.caretaker.salvar(this.texto);
                    System.out.println("O estado atual do texto foi salvo.");
                    break;
                case "d":
                    System.out.println("Os estados salvos do texto são:");
                    this.caretaker.visualizar();
                    System.out.println("Digite um número referente a um estado da lista para visualizar:");
                    int i = sc.nextInt();
                    sc.nextLine();
                    this.caretaker.carregar(this.texto, i);
                    System.out.println("O estado do texto foi carregado.");
                    break;
                case "e":
                    sair = true;
                    break;
                default:
                    System.out.println("Digite uma opção do menu.");
            }
        }
    }

    public static void main(String[] args) {
        Main main = new Main();
        main.executar();
    }
}
