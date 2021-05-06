import { Repository } from 'typeorm';
import { InjectRepository } from 'typeorm-typedi-extensions';
import { Resolver, Query, Arg } from 'type-graphql';
import { User } from '../entities';

@Resolver(() => User)
export class UserResolver {
    constructor(
        @InjectRepository(User) private readonly userRepository: Repository<User>
    ) { }

    @Query(() => [User])
    async users(): Promise<User[]> {
        return await this.userRepository.find({
            relations: ["roles"]
        });
    }

    @Query(() => User)
    async user(@Arg("id") id: number): Promise<User> {
        var user = await this.userRepository.findOne({
            where: {id},
            relations: ["roles"]
        })
        return user;
    }
}
