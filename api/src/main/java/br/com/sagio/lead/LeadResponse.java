package br.com.sagio.lead;
import java.time.Instant;
public record LeadResponse(Long id,String mensagem,Instant recebidoEm) { public static LeadResponse from(Lead lead){return new LeadResponse(lead.getId(),"Solicitação recebida com sucesso.",lead.getCreatedAt());} }