import static java.lang.System.out;
import java.util.*;
import java.io.*;

/**
 * Classe principal do projecto
 */
public class GESTAC
{
    private static Corretora lucroMax=new Corretora();//Corectora da GESTAC
    private static FicheiroDeClientes fichClientes = new FicheiroDeClientes();//ficheiro de clientes da GESTAC

    public static void main()
    {
        int controlo=1;//opções de menus
        Input teclado = new Input();//usar para leitura
        String codigoAux="";
        String nomeTituloAux="";

        boolean ok = false;
        out.println("Introduza o nome do ficheiro .obj da corretora:");//usar lucromax.obj
        while(!ok){
            try{
                ObjectInputStream ooin = new ObjectInputStream(new FileInputStream(teclado.lerString()));
                lucroMax = (Corretora)ooin.readObject();
                ooin.close();
                ok=true;
            }catch(IOException e){out.println("Ficheiro não encontrado!\nIntroduza novamente:");}catch(ClassNotFoundException c){};}
        ok=false;
        out.println("Introduza o nome do ficheiro .obj do ficheiro de clientes:");//usar ficheiro.obj
        while(!ok){
            try{
                ObjectInputStream ooin = new ObjectInputStream(new FileInputStream(teclado.lerString()));
                fichClientes = (FicheiroDeClientes)ooin.readObject();
                ooin.close();
                ok =true;
            }catch(IOException e){out.println("Ficheiro não encontrado!\nIntroduza novamente:");}catch(ClassNotFoundException c){};}

        while(controlo!=0)
        {
            out.println("Prima enter!");
            teclado.lerString();
            menuPrincipal();
            controlo=teclado.lerInt();
            switch(controlo)
            {
                case 0:break;//sai programa

                case 1://OPÇÂO 1 MENU PRINCIPAL-REGISTAR CLIENTE
                FichaDeCliente fc= new FichaDeCliente();
                out.println("Introduza respectivamente:");
                out.println("Codigo,Nome,Idade,Número de Contribuinte,Morada:");
                codigoAux=teclado.lerString();
                if(!fichClientes.getFicheirosDeClientes().containsKey(codigoAux))// se codigo ainda nao existir pode.se registar cliente
                    fichClientes.inserirFichaCliente(new FichaDeCliente(codigoAux,teclado.lerString(),teclado.lerInt(),teclado.lerString(),teclado.lerString()));
                else
                    out.println("Codigo ja existente!");
                break;

                case 2://OPÇÂO 2 MENU PRINCIPAL- Consulta Carteira
                menuCart();
                controlo=teclado.lerInt();
                switch(controlo)
                {
                    case 1://opção 1 MENU CART - Determinar existencia de um título dado nome:
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Nome título:");
                            nomeTituloAux=teclado.lerString();
                            if(lucroMax.getCorretora().get(codigoAux).procurarTituloNome(nomeTituloAux))//determinar existencia de titulo
                            {
                                out.println("Título encontrado!");
                            }else{out.println("Nenhum título encontrado!");}

                        }else{out.println("Nenhuma carteira associada ao código!!");}

                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 2://opção 2 MENU CART - Quantidade de acções de dado nome:
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Nome título:");
                            nomeTituloAux=teclado.lerString();
                            out.println("Quantidade"+lucroMax.getCorretora().get(codigoAux).numAccoes(nomeTituloAux));

                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;
                    case 3://opção 3 MENU CART - Quantidade de fundos de dado nome
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Nome do fundo:");
                            nomeTituloAux = teclado.lerString();
                            if(lucroMax.getCorretora().get(codigoAux).procurarTituloNome(nomeTituloAux))//determinar existencia de titulo
                            {
                                out.println("Título encontrado!");
                                out.println("Quantidade de fundos:" + lucroMax.getCorretora().get(codigoAux).numFundos(nomeTituloAux));
                            }else{out.println("Nenhum título encontrado!");}
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 4://opção 4 MENU CART - Total Acções
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Total de accoes: " + lucroMax.getCorretora().get(codigoAux).qtdAccoes());
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 5://opção 5 MENU CART - Total fundos
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Total de fundos: "+lucroMax.getCorretora().get(codigoAux).qtdFundos());
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}
                    break;

                    case 6://opção 6 MENU CART - Titulo mais lucrativo
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Titulo mais lucrativo: "+lucroMax.getCorretora().get(codigoAux).tituloMaisLucrativo());
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 7://opção 7 MENU CART - Lucro absoluto
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Lucro Absoluto: "+lucroMax.getCorretora().get(codigoAux).lucroAbs());
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 8://opção 8 MENU CART - Consultar titulo dado nome
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();

                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("\nNome título:");
                            nomeTituloAux=teclado.lerString();
                            if(lucroMax.getCorretora().get(codigoAux).procurarTituloNome(nomeTituloAux))//determinar existencia de titulo
                            {
                                out.println(lucroMax.getCorretora().get(codigoAux).getTituloNome(nomeTituloAux).toString());
                            }else{out.println("Nenhum título encontrado!");}
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 9://opção 9 MENU CART - Eliminar titulo da carteira
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Nome título:");
                            nomeTituloAux=teclado.lerString();
                            if(lucroMax.getCorretora().get(codigoAux).procurarTituloNome(nomeTituloAux))//determinar existencia de titulo
                            {
                                lucroMax.removeTituloCarteira(nomeTituloAux,codigoAux);
                                out.println("Título removido com sucesso.\n");
                            }else{out.println("Nenhum título encontrado!");}
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 10://opção 10 MENU CART - Listar nomes dos titulos
                    HashSet<String> aux=new HashSet<String>();
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Lista Títulos:\n ");
                            aux=lucroMax.getCorretora().get(codigoAux).listaNomes();
                            Iterator<String> itNome = aux.iterator();
                            while(itNome.hasNext())
                                out.println(itNome.next());

                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 11://opção 11 MENU CART - Investimento total na aquisição dos titulos
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Lucro Absoluto: "+lucroMax.getCorretora().get(codigoAux).investTotal());
                        }else{out.println("Nenhuma carteira associada ao código!!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    case 12://opção 12 MENU CART - Registar venda de um titulo
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))//verificar se código tem registo
                    {
                        if(lucroMax.getCorretora().containsKey(codigoAux))//verificar se existe carteira com dado código
                        {
                            out.println("Nome:");
                            nomeTituloAux=teclado.lerString();
                            if(lucroMax.getCorretora().get(codigoAux).getCarteira().containsKey(nomeTituloAux))
                            {
                                out.println("Quantidade:");
                                int qtd=teclado.lerInt();
                                if(lucroMax.getCorretora().get(codigoAux).getCarteira().get(nomeTituloAux) instanceof Accao){
                                    Accao a = (Accao) lucroMax.getCorretora().get(codigoAux).getCarteira().get(nomeTituloAux);
                                    if(a.getNParticipacoes() > qtd){
                                        lucroMax.registoVendaTituloC(qtd,nomeTituloAux,codigoAux);
                                    }
                                    else  out.println("Quantidade inválida!");
                                }
                                else
                                if(lucroMax.getCorretora().get(codigoAux).getCarteira().get(nomeTituloAux) instanceof Fundo){
                                    Fundo f = (Fundo) lucroMax.getCorretora().get(codigoAux).getCarteira().get(nomeTituloAux);
                                    if(f.getNumUnidadesCompradas() > qtd){
                                        lucroMax.registoVendaTituloC(qtd,nomeTituloAux,codigoAux);
                                    }
                                    else  out.println("Quantidade inválida!");
                                }
                            }else{out.println("Titulo inexistente!");}    
                        }else{out.println("Nenhuma carteira associada ao código!");}
                    }else{out.println("Código não se encontra válido!");}

                    break;

                    default:out.println("Opção inválida!");
                }
                break;

                case 3://OPÇÂO 3 MENU PRINCIPAL- Consulta Corretora
                menuCorret();
                controlo=teclado.lerInt();
                switch(controlo)
                {
                    case 1://opção 1 MENU CORRET - Inserir Carteira
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(fichClientes.getFicheirosDeClientes().containsKey(codigoAux))
                    {
                        lucroMax.inserirCarteira(new Carteira(codigoAux,new TreeMap<String,Titulo>()));
                        out.println("Carteira criada e adicionada à corretora!");
                    }
                    else
                        out.println("Código não se encontra válido!");
                    break;

                    case 2://opção 2 MENU CORRET - Remover Carteira
                    out.println("Codigo do titular:");
                    codigoAux=teclado.lerString();
                    if(lucroMax.getCorretora().containsKey(codigoAux))
                    {
                        lucroMax.removerCarteira(lucroMax.getCorretora().get(codigoAux));//remove carteira com dado codigo
                        out.println("Carteira removida!");
                    }
                    else
                        out.println("Código incorreto");

                    break;
                    case 3://opção 3 MENU CORRET - Inserir titulo numa Carteira

                    out.println("Código do titular:");
                    codigoAux=teclado.lerString();
                    if(lucroMax.getCorretora().containsKey(codigoAux))//verificar existencia carteira
                    {   
                        menuTitulo();
                        controlo=teclado.lerInt();
                        switch(controlo)
                        {
                            case 1://ACCAO
                            out.println("Introduza respectivamente:");
                            out.println("Nome da Acção:");
                            out.println("Valor de compra:");
                            out.println("Valor de venda:");
                            out.println("Número de participações:");
                            out.println("Taxa de compra:");
                            out.println("Taxa de venda:");
                            lucroMax.insereTituloCarteira(new Accao(teclado.lerString(),teclado.lerDouble(),teclado.lerDouble(),teclado.lerInt(),teclado.lerDouble(),teclado.lerDouble()),codigoAux);
                            out.println("Acção inserida!");
                            break;
                            case 2://FUNDO
                            out.println("Introduza respectivamente:");
                            out.println("Nome do Fundo:");
                            out.println("Número de unidades compradas:");
                            out.println("Preço de Compra:");
                            out.println("Valor atual total:");
                            out.println("Variação data compra:");
                            out.println("Ano, mês, dia:");
                            lucroMax.insereTituloCarteira(new Fundo(teclado.lerString(),teclado.lerInt(),teclado.lerDouble(),teclado.lerDouble(),teclado.lerDouble(),new GregorianCalendar(teclado.lerInt(),teclado.lerInt(),teclado.lerInt())),codigoAux);
                            out.println("Fundo inserido!");
                            break;
                            default: out.println("Opção incorreta!");
                        }     
                    }
                    else
                        out.println("Nenhuma carteira encontrada!");

                    break;
                    case 4://opção 4 MENU CORRET - Remover título de uma Carteira
                    out.println("Código do titular:");
                    codigoAux=teclado.lerString();
                    if(lucroMax.getCorretora().containsKey(codigoAux)){
                        out.println("Introduza o nome do título");
                        nomeTituloAux=teclado.lerString();
                        if(lucroMax.getCorretora().get(codigoAux).procurarTituloNome(nomeTituloAux))
                        {
                            lucroMax.removeTituloCarteira(nomeTituloAux,codigoAux);
                        }
                        else
                        {
                            out.println("Não foi encontrada nenhum título com esse nome!");
                        }

                    }
                    else
                        out.println("Código incorreto");
                    break;

                    case 5://opção 5 MENU CORRET - Imprimir ficha clientes
                    out.println(fichClientes.toString());
                    break;

                    case 6://opção 6 MENU CORRET - Quantidade de titulos geridos
                    out.println("Quantidade títulos geridos: "+lucroMax.totalTitulos());
                    break;

                    case 7://opção 7 MENU CORRET - Valor monetário total gerido
                    out.println("Valor monetário total gerido: "+lucroMax.valorMonetarioTotal());
                    break;

                    case 8://opção 8 MENU CORRET - Nome do titular com mais lucro
                    out.println("Nome do titular com mais lucro: "+lucroMax.titularMaisLucro(fichClientes));
                    break;

                    case 9://opção 9 MENU CORRET - Nome dos titulares dado nome do titulo
                    out.println("Introduza o nome do título");
                    nomeTituloAux=teclado.lerString();
                    if(lucroMax.procuraTituloDadoNome(nomeTituloAux))
                    {
                        out.println("Nome:");
                        Iterator<String> nomTitul = lucroMax.nomesTitularesTitulos(nomeTituloAux,fichClientes).iterator();
                        while(nomTitul.hasNext())
                            out.println(nomTitul.next());
                    }else{out.println("Nome de título não encontrado!");}
                    break;

                    case 10://opção 10 MENU CORRET - Conjunto de Acções em descida
                    Iterator<Accao> acDes = lucroMax.accoesEmDescida().iterator();
                    while(acDes.hasNext())
                        out.println(acDes.next().getNome());

                    break;

                    case 11://opção 11 MENU CORRET - Fundos com rendimento superior a um valor dado
                    out.println("Valor:");

                    TreeMap<String,Fundo> auxfundo =  new TreeMap<String,Fundo>();
                    auxfundo=lucroMax.fundosRendimentoSuperior(teclado.lerDouble());
                    out.println("Lista Títulos:\n");
                    for(Fundo f : auxfundo.values())
                        out.println(f.toString());
                    break;

                    case 12://opção 12 MENU CORRET - Imprimir Corretora
                    out.println(lucroMax.toString());
                    break;

                    case 13://opção 13 MENU CORRET - Guardar Corretora 

                    out.println("Introduza o nome do ficheiro da corretora .obj:");
                    try {

                        lucroMax.criarObj(teclado.lerString());
                    }
                    catch(IOException e) { out.println("Ficheiro não encontrado!");}

                    out.println("Introduza o nome do ficheiro da corretora .txt:");
                    try {
                        lucroMax.gravaTxt(teclado.lerString());
                    }
                    catch(IOException e) {out.println("Ficheiro não encontrado!");}

                    out.println("Introduza o nome do ficheiro de clientes .obj:");
                    try {
                        fichClientes.criarObj(teclado.lerString());
                    }
                    catch(IOException e) {out.println("Ficheiro não encontrado!");}

                    break;

                    default:out.println("Opção inválida!");
                }
                break;
                default:
                out.println("Opção inválida!");//opção invalida do programa main
            }
        }//FIM WHILE DO PROGRAMA PRINCIPAL
        out.println("Até já.\nObrigado pela escolha da "+lucroMax.getNome());
    }

    /**
     * Menu principal
     */
    public static void menuPrincipal()
    {
        //empresa com funçao de corretora - LUCROMAX
        out.println("******************************");
        out.println("Nome corretora:"+lucroMax.getNome());
        out.println("******************************");
        out.println("*1-Registar cliente:         *");
        out.println("*2-Consultar Carteira:       *");
        out.println("*3-Consultar Corretora:      *");
        out.println("*0-Sair                      *");
        out.println("******************************\n");
    }

    /**
     * Menu de escolha do tipo de titulo
     */
    public static void menuTitulo()
    {
        out.println("****************");
        out.println("*1-Accao       *");
        out.println("*2-Fundo       *");
        out.println("****************\n");
    }

    /**
     * Menu da carteira
     */
    public static void menuCart()
    {   
        out.println("**************************************************");
        out.println("*1-Determinar existencia de um título:           *");
        out.println("*2-Quantidade de acções de dado nome:            *");
        out.println("*3-Quantidade de fundos de dado nome:            *");
        out.println("*4-Total Acções:                                 *");
        out.println("*5-Total fundos:                                 *");
        out.println("*6-Titulo mais lucrativo:                        *");
        out.println("*7-Lucro absoluto:                               *");
        out.println("*8-Consultar titulo dado nome:                   *");
        out.println("*9-Eliminar titulo da carteira:                  *");
        out.println("*10-Listar nomes dos titulos:                    *");
        out.println("*11-Investimento total na aquisição dos titulos: *");
        out.println("*12-Registar venda de um titulo:                 *");
        out.println("**************************************************\n");
    }

    /**
     * Menu da corretora
     */
    public static void menuCorret()
    {
        out.println("****************************************************");
        out.println("*1-Inserir Carteira:                               *");
        out.println("*2-Remover Carteira:                               *");
        out.println("*3-Inserir titulo numa Carteira:                   *");
        out.println("*4-Remover titulo de uma Carteira:                 *");
        out.println("*5-Imprimir ficha clientes:                        *");
        out.println("*6-Quantidade de titulos geridos:                  *");
        out.println("*7-Valor monetário total gerido:                   *");
        out.println("*8-Nome do titular com mais lucro:                 *");
        out.println("*9-Nome dos titulares dado nome do titulo:         *");
        out.println("*10-Conjunto de Acções em descida:                 *");
        out.println("*11-Fundos com rendimento superior a um valor dado:*");
        out.println("*12-Imprimir Corretora:                            *");
        out.println("*13-Guardar Corretora:                             *");//guardar num ficheiro...
        out.println("****************************************************\n");
    }
}