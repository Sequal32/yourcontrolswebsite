import { Entity, Column, BeforeInsert, PrimaryColumn , JoinTable, ManyToMany } from 'typeorm';
import { Snowflake } from "../utils"
import Role from "./Role"
import * as bcrypt from 'bcryptjs';
import { ObjectType, Field } from 'type-graphql';

@Entity()
@ObjectType()
export default class User {
    @Field()
    @PrimaryColumn({type:"bigint"})
    id: number;

    @Field()
    @Column({ length: 50 })
    username: string;

    @Field()
    @Column({ unique: true})
    email: string;

    @Column({ select: false })
    password: string;

    @Field((type) => [Role])
    @ManyToMany(() => Role)
    @JoinTable()
    roles: Role[]

    @BeforeInsert()
    async hashPassword() {
        this.password = await bcrypt.hash(this.password, 10);
    }

    @BeforeInsert()
    async generateID() {
        let snowflake = Snowflake.generate()
        this.id =  parseInt(snowflake.id)
    }

    async comparePassword(attempt: string): Promise<boolean> {
        return await bcrypt.compare(attempt, this.password);
    }
}

