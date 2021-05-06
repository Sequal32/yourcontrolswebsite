import { Field, ObjectType } from 'type-graphql';
import {
  Column,
  Entity,
  BeforeInsert,
  PrimaryColumn
} from 'typeorm';
import { Snowflake } from '../utils';

@Entity()
@ObjectType()
export default class Post {
    constructor() {}
    @Field()
    @PrimaryColumn()
    public id: number;

    @Field()
    @Column()
    public role: string;

    @Field()
    @Column()
    public roleName: string;

    @BeforeInsert()
    async generateID() {
        let snowflake = Snowflake.generate()
        this.id =  parseInt(snowflake.id)
    }
}
