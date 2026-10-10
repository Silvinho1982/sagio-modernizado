import { describe, expect, it } from "vitest";
import { z } from "zod";
const leadSchema=z.object({nome:z.string().trim().min(2),email:z.string().email(),telefone:z.string().min(8)});
describe("validação básica de lead",()=>{it("aceita dados válidos",()=>{expect(leadSchema.safeParse({nome:"Maria Silva",email:"maria@example.com",telefone:"86999999999"}).success).toBe(true)});it("rejeita e-mail inválido",()=>{expect(leadSchema.safeParse({nome:"Maria Silva",email:"invalido",telefone:"86999999999"}).success).toBe(false)})});